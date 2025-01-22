<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PaymentController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        // Fetch all payments sorted by payment date (latest first)
        $payments = Payment::orderBy('payment_date', 'desc')->get();


        // Return view with payment data
        return view('adminBackend.payments.index', compact('payments', 'user'));
    }
    public function paymentcreate($transaction_id)
    {
        $user = Auth::user();
        // Fetch the transaction details, including order and customer data
        $transaction = Transaction::with('order', 'customer')->where('transaction_id', $transaction_id)->firstOrFail();

        // Get the total amount from the transaction
        $totalAmount = $transaction->total_amount;

        // Pass data to the payment form view
        return view('adminBackend.payments.create', compact('transaction', 'totalAmount', 'user'));
    }
    // Store the payment data
    public function paymentstore(Request $request)
    {
        Log::info('Incoming Request:', $request->all());

        // Validation
        $request->validate([
            'transaction_id' => 'required|exists:transactions,transaction_id',
            'payment_method' => 'required',
            'payment_amount' => 'required|numeric|min:0',
            'change_amount' => 'required|numeric|min:0',
            'payment_status' => 'required',
        ]);

        // Fetch the transaction
        $transaction = Transaction::where('transaction_id', $request->transaction_id)->firstOrFail();

        // Fetch the payment if it already exists
        $existingPayment = Payment::where('transaction_id', $transaction->id)->first();

        if ($existingPayment) {
            // Update the existing payment record
            $existingPayment->update([
                'payment_method' => $request->payment_method,
                'payment_amount' => $request->payment_amount,
                'change_amount' => $request->change_amount,
                'payment_status' => $request->payment_status,
                'payment_date' => now(),
            ]);

            $payment = $existingPayment; // For further use in invoice generation or other logic
        } else {
            // Generate a unique payment ID
            $paymentId = 'PAY-' . strtoupper(Str::random(6));

            // Create a new payment record
            $payment = Payment::create([
                'payment_id' => $paymentId,
                'transaction_id' => $transaction->id,
                'payment_method' => $request->payment_method,
                'total_amount' => $transaction->total_amount,
                'payment_amount' => $request->payment_amount,
                'change_amount' => $request->change_amount,
                'payment_status' => $request->payment_status,
                'payment_date' => now(),
            ]);
        }

        // Calculate Customer Due Amount and Advance Amount--------------------------------------------------------------------------------
        // Fetch the customer
        $customer = Customer::where('barcode_number', $transaction->customer_barcode)->firstOrFail();

        $totalAmount = $transaction->total_amount;
        $paymentAmount = $request->payment_amount;
        $changeAmount = $request->change_amount;

        // Ensure paymentAmount is valid
        if ($paymentAmount > 0) {
            // Calculate exchange
            $exchange = $paymentAmount - $totalAmount;

            if ($exchange >= 0) {
                // Payment covers or exceeds totalAmount
                if ($exchange == $changeAmount) {
                    // Exact change provided
                    $countAmount = $exchange - $changeAmount;
                    $customer->advance_amount += $countAmount;
                } else {
                    // Update advance based on mismatched change
                    $customer->advance_amount += ($exchange - $changeAmount);
                }
            } else {
                // Payment is less than totalAmount, update due
                $customer->due_amount += abs($exchange);
            }

            // Save the updated customer data
            $customer->save();
        }


        // Log the payment and total amount
        Log::info("Payment Amount: $paymentAmount, Total Amount: {$transaction->total_amount}");

        // Update Order, Cart, Product status and Quantity--------------------------------------------------------------------------------
        $order = Order::where('order_id', $transaction->order_id)->firstOrFail();
        $cart = Cart::where('cart_id', $order->cart_id)->firstOrFail();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();



        if ($request->payment_status === 'completed') {
            $order->update(['status' => 'complete']);
            $cart->update(['status' => 'complete']);

            foreach ($cartItems as $cartItem) {
                $product = Product::where('product_barcode', $cartItem->product_barcode)->firstOrFail();
                $product->decrement('stock_quantity', $cartItem->quantity);


                // Calculate sales data
                $sellPrice = $cartItem->price;
                $buyPrice = $product->buy_price;
                $totalSellPrice = $sellPrice * $cartItem->quantity;
                $totalBuyPrice = $buyPrice * $cartItem->quantity;
                $profit = $totalSellPrice - $totalBuyPrice;
                $margin = $profit > 0 ? ($profit / $totalSellPrice) * 100 : 0;



                $productsale = ProductSale::updateOrCreate(
                    [
                        'payment_id' => $payment->payment_id ?? null,  // Check for existing payment_id
                        'order_id' => $order->order_id,  // Ensure the correct order_id
                        'cart_item_id' => $cartItem->id,  // Ensure the correct cart_item_id
                    ],
                    [
                        'cart_id' => $cart->cart_id,
                        'product_id' => $product->product_id,
                        'transaction_id' => $transaction->transaction_id ?? null,
                        'supplier_id' => $product->supplier_id,
                        'quantity' => $cartItem->quantity,
                        'sell_price' => $sellPrice,
                        'buy_price' => $buyPrice,
                        'total_sell_price' => $totalSellPrice,
                        'total_buy_price' => $totalBuyPrice,
                        'profit' => $profit,
                        'margin' => $margin,
                        'sale_date' => now(),
                    ]
                );
            }
        }
        Log::info("$transaction->id");

        // Generate Invoice and store Table--------------------------------------------------------------------------------
        // Generate Invoice and store Table--------------------------------------------------------------------------------
        $invoiceId = 'INV-' . strtoupper(Str::random(6));
        $barcodeDirectory = public_path('baackend_images/invoice_barcodes');
        if (!File::exists($barcodeDirectory)) {
            File::makeDirectory($barcodeDirectory, 0755, true);
        }

        // Check if an invoice already exists for this order
        $existingInvoice = Invoice::where('order_id', $order->id)->first();

        if ($existingInvoice) {
            // If invoice exists, update the existing one
            $existingInvoice->update([
                'invoice_barcode' => $invoiceId,
                'invoice_barcode_image' => 'baackend_images/invoice_barcodes/' . $invoiceId . '.png',
                'transaction_id' => $transaction->id ?? null,
                'payment_id' => $payment->id ?? null,
                'subtotal' => $order->subtotal,
                'tax' => $order->tax,
                'shipping_cost' => $order->shipping_cost,
                'discount' => $order->discount,
                'total' => $order->round_total,
                'paid_amount' => $request->payment_amount,
                'change_amount' => $request->change_amount,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_status,
            ]);

            // Assign the updated invoice to the $invoice variable
            $invoice = $existingInvoice;
        } else {
            // If no existing invoice, create a new one
            $generator = new BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode($invoiceId, $generator::TYPE_CODE_128);
            $barcodeImage = $barcodeDirectory . '/' . $invoiceId . '.png';
            file_put_contents($barcodeImage, $barcode);

            $invoice = Invoice::create([
                'invoice_id' => $invoiceId,
                'invoice_barcode' => $invoiceId,
                'invoice_barcode_image' => 'baackend_images/invoice_barcodes/' . $invoiceId . '.png',
                'order_id' => $order->id,
                'customer_id' => $order->customer_id,
                'transaction_id' => $transaction->id ?? null,
                'payment_id' => $payment->id ?? null,
                'subtotal' => $order->subtotal,
                'tax' => $order->tax,
                'shipping_cost' => $order->shipping_cost,
                'discount' => $order->discount,
                'total' => $order->round_total,
                'paid_amount' => $request->payment_amount,
                'change_amount' => $request->change_amount,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_status,
            ]);
        }

        // Redirect to the invoice detail page
        return redirect()->route('invoices.show', ['invoice' => $invoice->id]);
    }
}
