<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Order extends Model
{
    protected $table = 'orders';
    // protected $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = [
        'order_id', 'uuid', 'cart_id', 'customer_id', 'product_name', 'quantity', 'subtotal',
        'tax', 'shipping_cost', 'discount', 'flat_discount', 'total', 'round_total', 'status'
    ];

    protected $casts = [
        'product_name' => 'array', // Cast the product_name as an array (JSON)
        'quantity' => 'array', // Cast quantity as an array (JSON)
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Generate a unique order ID in the format "ORDER-XXXXX"
            $order->order_id = 'ORDER-' . strtoupper(Str::random(6));

            // Ensure UUID is set if not already
            if (empty($order->uuid)) {
                $order->uuid = (string) Str::uuid();
            }
        });
    }

    // Define the relationship with the Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function cartitems()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }

    // Define the relationship with the Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Define the relationship with the OrderItem model
public function items()
{
    return $this->hasMany(OrderItem::class, 'order_id', 'id');
}
}


