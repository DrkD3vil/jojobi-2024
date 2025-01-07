<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Fetch products and other necessary data
        $products = Product::all();
        
        return view('adminBackend.transactions.index', compact('products', 'user'));
    }
    public function addProduct(Request $request)
    {
        // Validate input
        $request->validate([
            'barcode' => 'required|string',
        ]);

        // Search product by barcode or name
        $product = Product::where('product_barcode', $request->barcode)
            ->orWhere('name', 'LIKE', '%' . $request->barcode . '%')
            ->first();

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        // Fetch the category details


        // Store product details in the session (or database for ongoing transactions)
        $cart = session()->get('cart', []);
        $cart[$product->id] = [
            'name' => $product->name,
            'barcode' => $product->product_barcode,
            'quantity' => isset($cart[$product->id]) ? $cart[$product->id]['quantity'] + 1 : 1,
            'price' => $product->sell_price,
            'category' => $product->category_id->category_name ?? 'N/A',
            'image' => $product->image ?? 'default.jpg',
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Product added successfully.');
    }

    public function removeProduct($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed successfully.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared successfully.');
    }

    public function checkout()
    {
        // Process the transaction
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Cart is empty.');
        }

        // Save transaction logic (e.g., store in a database)

        session()->forget('cart');
        return back()->with('success', 'Transaction completed successfully.');
    }
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
