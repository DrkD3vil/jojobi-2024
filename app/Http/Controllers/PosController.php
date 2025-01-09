<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{
    // Show the POS index page
    public function showPos(Request $request)
    {
        $user = Auth::user();
        // Get the cart from session or database if empty
        $cart = session('cart', []);
        if (empty($cart)) {
            $cart_id = $request->session()->get('cart_id');
            if ($cart_id) {
                $cart_data = Cart::where('cart_id', $cart_id)->first();
                if ($cart_data) {
                    $cart = json_decode($cart_data->items, true);
                }
            }
        }

        // Calculate the subtotal price based on the cart data
        $subtotal_price = 0;
        foreach ($cart as $item) {
            $subtotal_price += $item['quantity'] * $item['price'];
        }

        return view('adminBackend.pos.index', compact('cart', 'subtotal_price', 'user'));
    }

    // Add product to the cart
    public function addProduct(Request $request)
    {
        $barcode = $request->input('barcode');
        $product = Product::where('product_barcode', $barcode)->orWhere('name', 'like', "%$barcode%")->first();

        if (!$product) {
            return redirect()->route('pos.index')->with('error', 'Product not found.');
        }

        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // If the product is already in the cart, update the quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            // Add the product to the cart
            $cart[$product->id] = [
                'id' => $product->id,
                'barcode' => $product->product_barcode,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->sell_price,
                'category' => $product->category->name ?? 'N/A',
                'image' => $product->image,
            ];
        }

        // Store the cart in the session
        session()->put('cart', $cart);
        session()->put('cart_id', uniqid()); // Generate a unique cart_id for persistence

        return redirect()->route('pos.index');
    }

    // Remove a product from the cart
    public function removeProduct($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('pos.index');
    }

    // Store the cart in the database and clear session
    public function storeCartInDatabase(Request $request)
    {
        $cart = session()->get('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('pos.index')->with('error', 'Cart is empty!');
        }
    
        // Generate a unique cart ID
        $cart_id = uniqid();
    
        // Save the cart to the database as JSON
        $cart_data = [
            'cart_id' => $cart_id,  // Generate a unique cart ID
            'uuid' => $request->uuid ?? null, // Optionally use a UUID for the user
            'status' => 'waiting',  // Status could be 'waiting', 'pending', 'complete'
            'items' => json_encode($cart), // Store the cart items as JSON
            'subtotal_price' => array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)), // Calculate the subtotal
        ];
    
        // Store the cart in the database
        Cart::create($cart_data);
    
        // Optionally clear the session cart after storing it
        // session()->forget('cart');
        // session()->forget('cart_id');
    
        // Redirect to orders.create with the cart_id
        return redirect()->route('orders.create', ['cart_id' => $cart_id])->with('success', 'Cart stored and cleared!');
    }
    

    // Update the cart data (e.g., quantity)
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->input('cart', []) as $id => $item) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $item['quantity'];
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('orders.create');
    }


    // Add More Products

    
}
