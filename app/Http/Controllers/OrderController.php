<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        $cart_id = $request->cart_id;

        // Fetch the cart by cart_id
        $cart = Cart::where('cart_id', $cart_id)->first();

        // Handle the case where the cart is not found
        if (!$cart) {
            return redirect()->route('pos.index')->with('error', 'Cart not found!');
        }

        // Fetch all customers for the form
        $customers = Customer::all();

        // Calculate subtotal price and include other cart data
        $cart->subtotal_price = array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], json_decode($cart->items, true)));

        // Pass data to the view
        return view('adminBackend.orders.create', compact('customers', 'cart', 'user'));
    }
    // app/Http/Controllers/CustomerController.php



    // Store order data
    // Store order data
public function store(Request $request)
{
    // Validate the input fields
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'cart_id' => 'required|exists:carts,cart_id',
        'tax' => 'required|numeric|min:0',
        'shipping_cost' => 'required|numeric|min:0',
        'discount' => 'required|numeric|min:0',
        'flat_discount' => 'nullable|numeric|min:0',
        'status' => 'required|in:pending,complete,suspended',
    ]);

    // Fetch the cart based on cart_id
    $cart = Cart::where('cart_id', $request->cart_id)->first();

    // Check if the order with the same cart_id already exists
    $order = Order::where('cart_id', $request->cart_id)->first();

    // If an order exists, update it; otherwise, create a new order
    if ($order) {
        // Update the existing order
        $order->customer_id = $request->customer_id;
        $order->subtotal = $cart->subtotal_price;
        $order->tax = $request->tax;

        // Calculate totals
        $subtotal = $cart->subtotal_price;
        $taxAmount = ($subtotal * $request->tax) / 100;
        $discountPercentage = ($subtotal * $request->discount) / 100;
        $total = $subtotal + $taxAmount + $request->shipping_cost - $discountPercentage;

        // Apply flat discount
        $total -= (float) $request->flat_discount;

        // Round total
        $decimalPart = $total - floor($total); // Get the decimal part of the total

        if ($decimalPart >= 0.50) {
            $roundTotal = ceil($total); // Round up
        } else {
            $roundTotal = floor($total); // Round down
        }

        // Update the order totals
        $order->shipping_cost = $request->shipping_cost;
        $order->discount = $request->discount;
        $order->flat_discount = $request->flat_discount ?? 0;
        $order->total = $total;
        $order->round_total = $roundTotal;
        $order->status = $request->status;

        // Fetch cart items for the current cart_id
        $cartItems = $cart->items;

        // Prepare the product names and quantities
        $productNames = [];
        $quantities = [];

        foreach ($cartItems as $item) {
            // Add product name and quantity to arrays
            $productNames[] = $item->product_name;
            $quantities[] = $item->quantity;
        }

        // Update product names and quantities in the order
        $order->product_name = json_encode($productNames);
        $order->quantity = json_encode($quantities);

        // Save the updated order
        $order->save();

        return redirect()->route('transactions.create', ['uuid' => $order->uuid])->with('success', 'Order has been successfully updated!');
    } else {
        // If no existing order, create a new one

        // Calculate subtotal, tax, total, and round total
        $subtotal = $cart->subtotal_price;
        $taxAmount = ($subtotal * $request->tax) / 100;
        $discountPercentage = ($subtotal * $request->discount) / 100;
        $total = $subtotal + $taxAmount + $request->shipping_cost - $discountPercentage;

        // Apply flat discount
        $total -= (float) $request->flat_discount;

        // Round total
        $decimalPart = $total - floor($total); // Get the decimal part of the total
        if ($decimalPart >= 0.50) {
            $roundTotal = ceil($total); // Round up
        } else {
            $roundTotal = floor($total); // Round down
        }

        // Create a new order record
        $order = new Order();
        $order->uuid = Str::uuid(); // Generating a UUID for the order
        $order->cart_id = $cart->cart_id;
        $order->customer_id = $request->customer_id;
        $order->subtotal = $subtotal;
        $order->tax = $request->tax;
        $order->shipping_cost = $request->shipping_cost;
        $order->discount = $request->discount;
        $order->flat_discount = $request->flat_discount ?? 0;
        $order->total = $total;
        $order->round_total = $roundTotal;
        $order->status = $request->status;

        // Fetch cart items for the current cart_id
        $cartItems = $cart->items;

        // Prepare the product names and quantities
        $productNames = [];
        $quantities = [];

        foreach ($cartItems as $item) {
            // Add product name and quantity to arrays
            $productNames[] = $item->product_name;
            $quantities[] = $item->quantity;
        }

        // Store the product names and quantities in the order (as JSON)
        $order->product_name = json_encode($productNames);
        $order->quantity = json_encode($quantities);

        // Save the order
        $order->save();

        return redirect()->route('transactions.create', ['uuid' => $order->uuid])->with('success', 'Order has been successfully created!');
    }
}







    public function index()
    {
        $user = Auth::user();
        $orders = Order::with(['customer', 'cartitems'])->get();
        Log::info('orders.index', ['orders' => $orders]);

        return view('adminBackend.orders.index', compact('orders', 'user'));
    }
}
