<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'product_barcode',
        'product_name',
        'product_image',
        'category_name',
        'quantity',
        'weight',
        'price',
    ];

    /**
     * Get the product associated with this cart item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    /**
     * Get the product associated with this cart item.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the cart that owns the cart item.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }
}
