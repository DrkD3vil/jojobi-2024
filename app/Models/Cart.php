<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'uuid',
        'status',
        'items',
        'subtotal_price',
    ];

    // protected $casts = [
    //     'items' => 'array', // Automatically cast items JSON to an array
    // ];

    /**
     * Get the cart items associated with this cart.
     */
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }
}
