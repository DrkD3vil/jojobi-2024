<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Table Name (optional if table name is not plural of model name)
    protected $table = 'orders';

    // Fillable Fields
    protected $fillable = [
        'user_id',
        'order_number',
        'product_details',
        'quantity',
        'subtotal_price',
        'tax',
        'shipping_cost',
        'discount',
        'total_price',
        'status',
    ];

    // Casts (for JSON fields)
    protected $casts = [
        'product_details' => 'array',
    ];

    /**
     * Relationship: Order belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique order number
     */
    public static function generateOrderNumber()
    {
        return 'ORD-' . strtoupper(uniqid());
    }

    /**
     * Calculate the total price of the order
     */
    public static function calculateTotalPrice($subtotal, $tax = 0, $shipping = 0, $discount = 0)
    {
        $total = $subtotal + $tax + $shipping - $discount;
        return max(0, $total); // Ensure total is not negative
    }

    /**
     * Get readable status
     */
    public function getReadableStatusAttribute()
    {
        $statuses = [
            'pending' => 'Pending',
            'completed' => 'Completed',
            'canceled' => 'Canceled',
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
}
