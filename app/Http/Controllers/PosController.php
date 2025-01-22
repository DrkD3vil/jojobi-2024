<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PosController extends Controller
{
    // Show the POS index page
    public function index()
    {
        $user = Auth::user();
        // Retrieve cart session or initialize an empty cart
        $cart = session()->get('cart', []);

        return view('adminBackend.pos.index', compact('cart', 'user'));
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('product_barcode', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->get()
            ->map(function ($product) {
                $product->out_of_stock = $product->stock_quantity <= 0;
                return $product;
            });

        // Log the data being returned
        Log::info('Search Results:', $products->toArray());

        return response()->json($products);
    }

    // public function addProduct(Request $request)
    // {
    //     $barcodeOrName = $request->input('barcode');

    //     // Search for the product by barcode or name
    //     $product = Product::where('product_barcode', $barcodeOrName)
    //         ->orWhere('name', 'like', "%{$barcodeOrName}%")
    //         ->first();

    //     if (!$product) {
    //         return redirect()->route('pos.index')->with('error', 'Product not found!');
    //     }

    //     // Fetch category name
    //     $category = Category::find($product->category_id);

    //     // If the category exists, use its name; otherwise, use 'Uncategorized'
    //     $categoryName = $category ? $category->category_name : 'Uncategorized';

    //     // Add product to cart
    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$product->id])) {
    //         // If product already exists in the cart, increment quantity
    //         $cart[$product->id]['quantity']++;
    //     } else {
    //         // If product is not in the cart, add it
    //         $cart[$product->id] = [
    //             'id' => $product->id,
    //             'barcode' => $product->product_barcode,
    //             'name' => $product->name,
    //             'image' => $product->image,
    //             'category' => $categoryName,  // Category name is set here
    //             'price' => $product->sell_price,
    //             'quantity' => 1,
    //         ];
    //     }

    //     session()->put('cart', $cart);

    //     return redirect()->route('pos.index')->with('success', 'Product added successfully!');
    // }

    public function addProduct(Request $request)
    {
        $barcodeOrName = $request->input('barcode');

        // Search for the product by barcode or name
        $product = Product::where('product_barcode', $barcodeOrName)
            ->orWhere('name', 'like', "%{$barcodeOrName}%")
            ->first();

        if (!$product) {
            return redirect()->route('pos.index')->with('error', 'Product not found!');
        }

        // Check if the product is out of stock
        if ($product->stock_quantity <= 0) {
            return redirect()->route('pos.index')->with('error', 'Product is out of stock!');
        } elseif ($product->weight <= 0) {
            return redirect()->route('pos.index')->with('error', 'Product has no weight specified!');
        }

        // Fetch category name
        $category = Category::find($product->category_id);

        // If the category exists, use its name; otherwise, use 'Uncategorized'
        $categoryName = $category ? $category->category_name : 'Uncategorized';

        // Add product to cart
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            // If the product already exists in the cart
            if ($product->weight > 0) {
                // For kilogram-based products, increment weight
                $cart[$product->id]['weight'] += $product->weight;
            } else {
                // For packet-based products, increment quantity
                $cart[$product->id]['quantity']++;
            }
        } else {
            // If product is not in the cart, add it
            $cart[$product->id] = [
                'id' => $product->id,
                'barcode' => $product->product_barcode,
                'name' => $product->name,
                'image' => $product->image,
                'category' => $categoryName,  // Category name is set here
                'price' => $product->sell_price,
                'quantity' => $request->quantity,
                'weight' =>  $request->weight,// Initialize for kilogram-based products
            ];
        }

        session()->put('cart', $cart);
        // Flash success message
        return redirect()->route('pos.index')->with('success', 'Product added successfully!');
    }









    public function removeProduct($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }



    public function proceedCart(Request $request)
    {
        $cartSession = session()->get('cart', []);

        if (empty($cartSession)) {
            return redirect()->route('pos.index')->with('error', 'Cart is empty!');
        }

        // Create a new cart in the database
        $cart = Cart::create([
            'cart_id' => uniqid('cart_'),
            'uuid' => uniqid('uuid_'),
            'status' => 'waiting',
            // 'items' => json_encode($cartSession),
            'subtotal_price' => array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $cartSession)),
        ]);

        // Add items to the cart_items table
        foreach ($cartSession as $item) {
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $item['id'],
                'product_barcode' => $item['barcode'],
                'product_name' => $item['name'],
                'product_image' => $item['image'],
                'category_name' => $item['category'], // Store category name here
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear session cart
        session()->forget('cart');

        return redirect()->route('orders.create', ['cart_id' => $cart->cart_id])->with('success', 'Cart has been successfully saved!');
    }


    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
        $quantity = $request->quantity;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        $subtotal_price = 0;
        foreach ($cart as $item) {
            $subtotal_price += $item['quantity'] * $item['price'];
        }

        return response()->json(['subtotal' => $subtotal_price]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        $subtotal_price = 0;
        foreach ($cart as $item) {
            $subtotal_price += $item['quantity'] * $item['price'];
        }

        return response()->json(['subtotal' => $subtotal_price]);
    }


    // Show all carts and their items
    public function showCarts()
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        // Fetch carts with their associated items, including product and category details
        $carts = Cart::with('items.product', 'items.category')->orderBy('created_at', 'desc')->get();

        // Pass the carts and user to the view
        return view('adminBackend.pos.show', compact('carts', 'user'));
    }


    // Show the cart and allow editing of cart items
    public function edit($cart_id)
    {
        $user = Auth::user();
        // Fetch the cart by cart_id
        $cart = Cart::with('items.product', 'items.category')->where('cart_id', $cart_id)->firstOrFail();

        // Return the edit view with the cart data
        return view('adminBackend.pos.edit', compact('cart', 'user'));
    }


    public function addCartItem(Request $request, $cart_id)
    {
        // Fetch the cart from the database using cart_id
        $cart = Cart::with('items')->where('cart_id', $cart_id)->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'Cart not found!');
        }

        // Get the barcode or product name from the request
        $barcodeOrName = $request->input('barcode');

        // Search for the product by barcode or name
        $product = Product::where('product_barcode', $barcodeOrName)
            ->orWhere('name', 'like', "%{$barcodeOrName}%")
            ->first();

        if (!$product) {
            return redirect()->route('carts.edit', $cart->cart_id)->with('error', 'Product not found!');
        }

        // Fetch category name
        $category = Category::find($product->category_id);
        $category_Name = $category ? $category->category_name : 'Uncategorized';

        // Check if the product already exists in the cart
        $existingItem = $cart->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            // If the product exists, increment its quantity
            $existingItem->increment('quantity');
        } else {
            // If the product doesn't exist, add it as a new cart item
            $cart->items()->create([
                'product_id' => $product->id,
                'product_barcode' => $product->product_barcode,
                'product_name' => $product->name,
                'product_image' => $product->image,
                'category_name' => $category_Name,
                'quantity' => 1,
                'price' => $product->sell_price,
            ]);
        }

        // Update the cart's subtotal
        $cart->subtotal_price = $cart->items->sum(fn($item) => $item->quantity * $item->price);
        $cart->save();

        // Redirect back to the cart edit page with success message
        return redirect()->route('carts.edit', $cart->cart_id)->with('success', 'Product added successfully!');
    }


    // In PosController.php

    public function updateQuantity(Request $request)
    {
        $cartItem = CartItem::findOrFail($request->input('id'));
        $newQuantity = $request->input('quantity');

        // Update the quantity
        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        // Recalculate the cart's subtotal
        $cart = $cartItem->cart;
        $cart->subtotal_price = $cart->items->sum(fn($item) => $item->quantity * $item->price);
        $cart->save();

        // Return the updated subtotal
        return response()->json([
            'subtotal' => $cart->subtotal_price,
        ]);
    }

    // In PosController.php

    public function removeCartItem(Request $request)
    {
        $cartItem = CartItem::findOrFail($request->input('id'));
        $cart = $cartItem->cart;

        // Remove the cart item
        $cartItem->delete();

        // Recalculate the cart's subtotal
        $cart->subtotal_price = $cart->items->sum(fn($item) => $item->quantity * $item->price);
        $cart->save();

        // Return the updated subtotal
        return response()->json([
            'subtotal' => $cart->subtotal_price,
        ]);
    }

    public function proceedCartItem(Request $request, $cart_id)
    {
        // Fetch the cart and its items
        $cart = Cart::with('items')->where('cart_id', $cart_id)->first();

        if (!$cart) {
            return redirect()->route('carts.edit', $cart_id)->with('error', 'Cart not found!');
        }

        // Update the quantities from the request
        foreach ($cart->items as $item) {
            $quantity = $request->input("quantity-{$item->id}");

            // If the quantity has changed, update it
            if ($quantity && $quantity != $item->quantity) {
                $item->quantity = $quantity;
                $item->save();
            }
        }

        // Recalculate the subtotal and save
        $cart->subtotal_price = $cart->items->sum(fn($item) => $item->quantity * $item->price);
        $cart->save();

        return redirect()->route('orders.creation', ['cart_id' => $cart->cart_id])->with('success', 'Cart has been successfully saved!');
    }



    public function orderCreation($cart_id)
    {
        // Fetch the cart from the database
        $cart = Cart::with('items')->where('cart_id', $cart_id)->first();

        if (!$cart) {
            return redirect()->route('carts.edit', $cart_id)->with('error', 'Cart not found!');
        }

        // Calculate totals and other information
        $subtotal = $cart->subtotal_price;
        $tax = 0.1 * $subtotal; // Example: 10% tax
        $shipping_cost = 00.00; // Flat shipping cost
        $discount_percentage = 0.00; // Example: 5% discount
        $flat_discount = 0.00; // Flat $5 discount
        $total = $subtotal + $tax + $shipping_cost - $flat_discount - $discount_percentage;
        $round_total = round($total, 2);

        // Create the order
        $order = Order::create([
            'uuid' => Str::uuid()->toString(),
            'cart_id' => $cart->cart_id,
            'customer_id' => $cart->customer_id,
            'product_name' => $cart->items->pluck('product_name')->toArray(),
            'quantity' => $cart->items->pluck('quantity')->toArray(),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping_cost' => $shipping_cost,
            'discount' => $discount_percentage,
            'flat_discount' => $flat_discount,
            'total' => $total,
            'round_total' => $round_total,
            'status' => 'pending', // Default status
        ]);

        // Redirect to the order details page with a success message
        return redirect()->route('orders.show', $order->order_id)->with('success', 'Order has been successfully created!');
    }
}
