<?php
// app/Services/CartService.php
namespace App\Services;

class CartService
{
    /**
     * Calculate the subtotal of the cart.
     *
     * @param array $cart
     * @return float
     */
    public function calculateSubtotal($cart)
    {
        return array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart));
    }

    /**
     * Calculate the total price including tax, shipping, and discount.
     *
     * @param array $cart
     * @param \Illuminate\Http\Request $request
     * @return float
     */
    public function calculateTotal($cart, $request)
    {
        $subtotal = $this->calculateSubtotal($cart);
        $taxAmount = $subtotal * ($request->input('tax', 0) / 100);
        return $subtotal + $taxAmount + $request->input('shipping_cost', 0) - $request->input('discount', 0);
    }
}
