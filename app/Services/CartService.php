<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Add a product to the cart.
     *
     * @param object $product
     * @param int $quantity
     * @param int|null $orderId
     * @return void
     */
    public function addToCart($product, $quantity = 1)
    {
        // Check if the product already exists in the cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->whereNull('order_id') // Ensure the cart is not yet associated with an order
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Update the existing cart item quantity
            $cartItem->quantity += $quantity;
        } else {
            // Create a new cart item
            $cartItem = new Cart();
            $cartItem->user_id = Auth::id();
            $cartItem->product_id = $product->id;
            $cartItem->product_name = $product->name;
            $cartItem->product_barcode = $product->product_barcode;
            $cartItem->category = $product->category->name ?? 'N/A';
            $cartItem->price = $product->sell_price;
            $cartItem->quantity = $quantity;
        }

        $cartItem->save();

        return $cartItem;
    }
    

    /**
     * Clear the cart for a specific user and order.
     *
     * @param int|null $orderId
     * @return void
     */
    public function clearCart()
    {
        // Clear all cart items for the current user
        Cart::where('user_id', Auth::id())
            ->whereNull('order_id')
            ->delete();
    }

    /**
     * Retrieve the cart items for a specific user and order.
     *
     * @param int|null $orderId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCart()
    {
        // Retrieve all cart items for the current user
        return Cart::where('user_id', Auth::id())
            ->whereNull('order_id')
            ->get();
    }

    /**
     * Calculate the subtotal price of the cart.
     *
     * @param \Illuminate\Support\Collection|array $cartItems
     * @return float
     */
    public function calculateSubtotal($cartItems)
    {
        return collect($cartItems)->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });
    }

    /**
     * Calculate the total price including tax, shipping, and discounts.
     *
     * @param \Illuminate\Support\Collection|array $cartItems
     * @param \Illuminate\Http\Request $request
     * @return float
     */
    public function calculateTotal($cartItems, $request)
    {
        $subtotal = $this->calculateSubtotal($cartItems);
        $taxAmount = $subtotal * ($request->input('tax', 0) / 100);

        return $subtotal
            + $taxAmount
            + $request->input('shipping_cost', 0)
            - $request->input('discount', 0);
    }

    /**
     * Check if the cart is empty.
     *
     * @param int|null $orderId
     * @return bool
     */
    public function isCartEmpty($orderId = null)
    {
        return !$this->getCart($orderId)->count();
    }
}
