<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        // Fetch all orders from the database
        $orders = Order::latest()->paginate(10); // Paginate 10 orders per page

        return view('adminBackend.orders.index', compact('orders', 'user'));
    }


    public function show($id)
    {
        $user = Auth::user();
        // Retrieve the order by ID
        $order = Order::findOrFail($id);

        // Decode the JSON product details into an array
        $products = json_decode($order->product_details, true);

        return view('adminBackend.orders.show', compact('order', 'products', 'user'));
    }

    public function edit($id)
{
    $user = Auth::user();
    $order = Order::findOrFail($id);

    // Use the product details stored in the order
    $cart = json_decode($order->product_details, true);

    return view('adminBackend.orders.edit', compact('order', 'cart', 'user'));
}


    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }



    public function update(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $cart = session()->get('cart', []);

        // Update the order with the new cart data
        $order->update([
            'product_details' => json_encode($cart),
            'quantity' => array_sum(array_column($cart, 'quantity')),
            'subtotal_price' => $this->cartService->calculateSubtotal($cart),
            'tax' => $request->input('tax', 0),
            'shipping_cost' => $request->input('shipping_cost', 0),
            'discount' => $request->input('discount', 0),
            'total_price' => $this->cartService->calculateTotal($cart, $request),
        ]);

        // If it's an AJAX request, return the updated data
        if ($request->ajax()) {
            // Calculate the updated totals
            $subtotal = $this->cartService->calculateSubtotal($cart);
            $tax = $request->input('tax', 0);
            $taxAmount = $subtotal * ($tax / 100);
            $total = $subtotal + $taxAmount + $request->input('shipping_cost', 0) - $request->input('discount', 0);

            return response()->json([
                'subtotal' => $subtotal,
                'total' => $total
            ]);
        }

        // Redirect back for non-AJAX requests
        return redirect()->route('orders.show', $order->id)->with('success', 'Order updated successfully.');
    }



    public function addProduct(Request $request, $orderId)
    {
        // Find the order
        $order = Order::findOrFail($orderId);

        // Get the product (search by barcode or product name)
        $product = Product::where('product_barcode', $request->input('barcode'))
            ->orWhere('name', 'like', '%' . $request->input('barcode') . '%')
            ->first();

        if (!$product) {
            return response()->json(['success' => false], 404); // Return a 404 error if product not found
        }

        // Retrieve cart from session or create a new one if empty
        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        if (isset($cart[$product->id])) {
            // If it exists, just update the quantity
            $cart[$product->id]['quantity']++;
        } else {
            // If it doesn't exist, add the product to the cart
            $cart[$product->id] = [
                'barcode' => $product->product_barcode,
                'name' => $product->name,
                'image' => $product->image,  // Assuming `image` column exists
                'category' => $product->category_id->category_name ?? 'N/A',  // Assuming the `category` relationship exists
                'price' => $product->sell_price,
                'quantity' => 1,
            ];
        }

        // Update the cart in session
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function proceed(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Update order status to "pending"
        $order->update(['status' => 'pending']);

        // Clear the cart after storing the order
        session()->forget('cart'); // Clear the cart from the session

        // Redirect to transaction creation page
        return redirect()->route('transactions.create', $orderId)
            ->with('success', 'Order is now pending. Proceed to payment.');
    }
}
