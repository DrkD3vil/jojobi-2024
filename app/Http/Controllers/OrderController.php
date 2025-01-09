<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'cart_id' => 'required|exists:carts,cart_id',
        'subtotal_price' => 'required|numeric',
        'tax' => 'required|numeric',
        'shipping_cost' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'total_price' => 'required|numeric',
    ]);

    // Fetch cart and customer details
    $cart = Cart::where('cart_id', $request->cart_id)->first();
    $customer = Customer::find($request->customer_id);

    if (!$cart || !$customer) {
        return redirect()->route('pos.index')->with('error', 'Invalid cart or customer.');
    }

    // Adjust total price with discount
    $discount = $request->discount ?? 0;
    $totalPrice = $request->subtotal_price + ($request->subtotal_price * $request->tax / 100) + $request->shipping_cost - $discount;

    // Create order
    $order = Order::create([
        'uuid' => Str::uuid(),
        'cart_id' => $cart->id,
        'customer_name' => $customer->name,
        'products_name' => json_encode(json_decode($cart->items, true)),
        'subtotal_price' => $request->subtotal_price,
        'tax' => $request->tax,
        'shipping_cost' => $request->shipping_cost,
        'total_price' => $totalPrice,
        'status' => 'pending',
    ]);

    return redirect()->route('orders.index')->with('success', 'Order created successfully!');
}


    public function index()
    {
        $user = Auth::user();
        $orders = Order::all();
        return view('adminBackend.orders.index', compact('orders', 'user'));
    }
}

