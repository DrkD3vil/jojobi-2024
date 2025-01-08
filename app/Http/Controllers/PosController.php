<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;

class PosController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        // Fetch products and other necessary data
        $products = Product::all();

        return view('adminBackend.pos.index', compact('products', 'user'));
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


        // Store product details in the session (or database for ongoing Orders)
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

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $updatedCart = $request->input('cart', []);
        $tax = $request->input('tax', 0);
        $shipping_cost = $request->input('shipping_cost', 0);
        $discount = $request->input('discount', 0);

        $subtotal = 0;

        foreach ($updatedCart as $id => $details) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = max(1, (int)$details['quantity']); // Ensure quantity is at least 1
                $subtotal += $cart[$id]['quantity'] * $cart[$id]['price'];
            }
        }

        session()->put('cart', $cart);
        session()->put('tax', $tax);
        session()->put('shipping_cost', $shipping_cost);
        session()->put('discount', $discount);

        $taxAmount = $subtotal * ($tax / 100);
        $total = $subtotal + $taxAmount + $shipping_cost - $discount;

        // Return JSON response for real-time updates
        return response()->json([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }




    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Cart is empty.');
        }

        // Save the cart as a draft order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => Order::generateOrderNumber(),
            'product_details' => json_encode($cart),  // Store cart as JSON
            'quantity' => array_sum(array_column($cart, 'quantity')),
            'subtotal_price' => $this->cartService->calculateSubtotal($cart),
            'tax' => $request->input('tax', 0), // Get tax from form input
            'shipping_cost' => $request->input('shipping_cost', 0), // Get shipping cost
            'discount' => $request->input('discount', 0), // Get discount
            'total_price' => $this->cartService->calculateTotal($cart, $request),
            'status' => 'draft',  // Set status as draft initially
        ]);

        // Store in session or redirect to edit page
        session()->put('order_id', $order->id);

        // Redirect to edit the order
        return redirect()->route('orders.show', $order->id)->with('success', 'Proceeding to order edit.');
    }

    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function someFunction($cart, $request)
    {
        $subtotal = $this->cartService->calculateSubtotal($cart);
        $total = $this->cartService->calculateTotal($cart, $request);

        // Continue with your logic...
    }






    // public function checkout()
    // {
    //     $cart = session()->get('cart', []);
    //     if (empty($cart)) {
    //         return back()->with('error', 'Cart is empty.');
    //     }

    //     // Retrieve session values
    //     $subtotal = array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart));
    //     $tax = session()->get('tax', 0);
    //     $shipping_cost = session()->get('shipping_cost', 0);
    //     $discount = session()->get('discount', 0);

    //     // Calculate totals
    //     $taxAmount = $subtotal * ($tax / 100);
    //     $total_price = $subtotal + $taxAmount + $shipping_cost - $discount;

    //     // Save order
    //     $order = Order::create([
    //         'user_id' => Auth::id(),
    //         'order_number' => Order::generateOrderNumber(),
    //         'product_details' => json_encode($cart), // Store as JSON
    //         'quantity' => array_sum(array_column($cart, 'quantity')),
    //         'subtotal_price' => $subtotal,
    //         'tax' => $taxAmount,
    //         'shipping_cost' => $shipping_cost,
    //         'discount' => $discount,
    //         'total_price' => $total_price,
    //         'status' => 'pending',
    //     ]);

    //     // Clear session
    //     session()->forget(['cart', 'tax', 'shipping_cost', 'discount']);

    //     return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully.');
    // }


}
