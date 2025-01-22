<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Picqer\Barcode\BarcodeGeneratorPNG;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch all transactions with related orders and customers using eager loading
        $transactions = Transaction::with(['order', 'customer'])->get();

        return view('adminBackend.transactions.index', compact('transactions', 'user'));
    }



    // Show the order and customer details for creating a transaction
    public function create($uuid)
    {
        $user = Auth::user();
        // Fetch the order using the uuid
        $order = Order::with('customer')->where('uuid', $uuid)->firstOrFail();

        // Get the customer details from the order
        $customer = $order->customer;

        // Calculate the total amount based on the due_amount and advance_amount fields
        $totalAmount = $order->round_total + $customer->due_amount - $customer->advance_amount;

        // Pass the data to the view
        return view('adminBackend.transactions.create', compact('order', 'customer', 'totalAmount', 'user'));
    }

    // Store the transaction in the database
    // public function store(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'order_id' => 'required|string', // Ensure order_id is provided and is a string
    //         'customer_barcode' => 'required|string', // Ensure customer_barcode is provided
    //         'total_amount' => 'required|numeric|min:0', // Ensure total_amount is provided and is numeric
    //         'payment_status' => 'required|in:pending,completed,failed', // Ensure valid payment_status
    //     ]);

    //     // Fetch the customer using the customer barcode
    //     $customer = Customer::where('barcode_number', $request->customer_barcode)->firstOrFail();
    //     $order = Order::where('order_id', $request->order_id)->firstOrFail();

    //     // Create the transaction
    //     $transection = Transaction::create([
    //         'transaction_id' => 'TRAN-' . Str::random(8), // Generate a unique transaction ID
    //         'order_id' => $request->order_id, // Use the order_id from the form input
    //         'customer_barcode' => $request->customer_barcode, // Use the customer_barcode from the form input
    //         'order_total_amount' => $order->round_total, // Get the round_total from the Order
    //         'customer_due' => $customer->due_amount, // Get the due_amount from the customer
    //         'customer_advance' => $customer->advance_amount, // Get the advance_amount from the customer
    //         'total_amount' => $request->total_amount, // Use the total_amount from the form input
    //         'payment_status' => $request->payment_status, // Use the payment_status from the form input
    //         'transaction_date' => now(), // Set the transaction date to the current timestamp
    //     ]);
    //     // customer Due and Advance Logic
    //     if ($order->round_total != $request->total_amount) {
    //         $addDue = $customer->due_amount + $request->round_total;
    //         $addAdvance =  $request->round_total - $customer->advance_amount;
    //         $dueAndadvance = $order->round_total + $customer->due_amount - $customer->advance_amount;
    //         if ($addDue == $request->total_amount) {
    //             $setDue = 0;
    //             $customer->update(['due_amount' => $setDue]);
    //         } elseif ($addAdvance == $request->total_amount) {
    //             $setAdvance = 0;
    //             $customer->update(['advance_amount' => $setAdvance]);
    //         } elseif ($dueAndadvance == $request->total_amount) {
    //             $setDue = 0;
    //             $setAdvance = 0;
    //             $customer->update(['due_amount' => $setDue, 'advance_amount' => $setAdvance]);
    //         }
    //     }
    //     // Redirect back to the create page with a success message
    //     return redirect()->route('payments.create', $transection->transaction_id)->with('success', 'Transaction created successfully!');
    // }


    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'order_id' => 'required|string', // Ensure order_id is provided and is a string
            'customer_barcode' => 'required|string', // Ensure customer_barcode is provided
            'total_amount' => 'required|numeric|min:0', // Ensure total_amount is provided and is numeric
            'payment_status' => 'required|in:pending,completed,failed', // Ensure valid payment_status
        ]);

        // Fetch the customer using the customer barcode
        $customer = Customer::where('barcode_number', $request->customer_barcode)->firstOrFail();
        $order = Order::where('order_id', $request->order_id)->firstOrFail();

        // Check if a transaction already exists for this order
        $existingTransaction = Transaction::where('order_id', $request->order_id)->first();

        // If a transaction exists, update it without changing customer due/advance amounts
        if ($existingTransaction) {
            $existingTransaction->update([
                'customer_barcode' => $request->customer_barcode, // Update customer barcode
                'order_total_amount' => $order->round_total, // Update the order total amount
                'total_amount' => $request->total_amount, // Update the total amount
                'payment_status' => $request->payment_status, // Update the payment status
                'transaction_date' => now(), // Update the transaction date
            ]);

            // Logic when payment status is failed
            if ($request->payment_status == 'failed') {
                // Update due_amount and advance_amount in the customer table
                $customer->due_amount += $existingTransaction->customer_due;
                $customer->advance_amount = max(0, $customer->advance_amount + $existingTransaction->customer_advance);
                $customer->save();
            } else{
                // Update due_amount and advance_amount in the customer table
                $customer->due_amount -= $existingTransaction->customer_due;
                $customer->advance_amount = max(0, $customer->advance_amount - $existingTransaction->customer_advance);
                $customer->save();
            }

            // Return a success message with the updated transaction
            return redirect()->route('payments.create', $existingTransaction->transaction_id)->with('success', 'Transaction updated successfully!');
        } else {
            // If no transaction exists, create a new one
            $transection = Transaction::create([
                'transaction_id' => 'TRAN-' . Str::random(8), // Generate a unique transaction ID
                'order_id' => $request->order_id, // Use the order_id from the form input
                'customer_barcode' => $request->customer_barcode, // Use the customer_barcode from the form input
                'order_total_amount' => $order->round_total, // Get the round_total from the Order
                'customer_due' => $customer->due_amount, // Get the due_amount from the customer
                'customer_advance' => $customer->advance_amount, // Get the advance_amount from the customer
                'total_amount' => $request->total_amount, // Use the total_amount from the form input
                'payment_status' => $request->payment_status, // Use the payment_status from the form input
                'transaction_date' => now(), // Set the transaction date to the current timestamp
            ]);

            // Logic for updating due_amount and advance_amount when payment status is 'failed'
            if ($request->payment_status == 'failed') {
                $customer->due_amount += $transection->customer_due; // Add the total amount of the transaction to due_amount
                $customer->advance_amount = max(0, $customer->advance_amount + $transection->customer_advance); // Subtract the total amount from advance_amount
                $customer->save();
            } else{
                $customer->due_amount -= $transection->customer_due; // Add the total amount of the transaction to due_amount
                $customer->advance_amount = max(0, $customer->advance_amount - $transection->customer_advance); // Subtract the total amount from advance_amount
                $customer->save();
            }

            // customer Due and Advance Logic (only executed when a new transaction is created)
            if ($order->round_total != $request->total_amount) {
                $addDue = $customer->due_amount + $request->round_total;
                $addAdvance =  $request->round_total - $customer->advance_amount;
                $dueAndadvance = $order->round_total + $customer->due_amount - $customer->advance_amount;

                if ($addDue == $request->total_amount) {
                    $setDue = 0;
                    $customer->update(['due_amount' => $setDue]);
                } elseif ($addAdvance == $request->total_amount) {
                    $setAdvance = 0;
                    $customer->update(['advance_amount' => $setAdvance]);
                } elseif ($dueAndadvance == $request->total_amount) {
                    $setDue = 0;
                    $setAdvance = 0;
                    $customer->update(['due_amount' => $setDue, 'advance_amount' => $setAdvance]);
                }
            }

            // Redirect back to the create page with a success message
            return redirect()->route('payments.create', $transection->transaction_id)->with('success', 'Transaction created successfully!');
        }
    }



    // Payment methods


    // Show payment form for a given transaction



    

    
}


// Example of transaction processing logic (store in a database)

// user_id
// product barcode
// product image
// product name
// category name
// quantity
// price
// subtotal price
// tax
// shipping cost
// discount 
// total price
