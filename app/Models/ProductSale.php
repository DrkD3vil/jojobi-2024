<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class ProductSale extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'order_id',
        'cart_id',
        'cart_item_id',
        'product_id',
        'payment_id',
        'transaction_id',
        'supplier_id',
        'quantity',
        'sell_price',
        'buy_price',
        'total_sell_price',
        'total_buy_price',
        'profit',
        'margin',
        'sale_date',
    ];

    /**
     * Define the relationship with the Order model.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Define the relationship with the Cart model.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    /**
     * Define the relationship with the CartItem model.
     */
    public function cartItem()
    {
        return $this->belongsTo(CartItem::class, 'cart_item_id');
    }

    /**
     * Define the relationship with the Product model.
     * This can be accessed through the CartItem relationship.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Define the relationship with the Payment model.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    /**
     * Define the relationship with the Supplier model (if applicable).
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
