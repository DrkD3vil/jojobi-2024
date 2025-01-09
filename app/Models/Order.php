<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Order extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's pluralization rule
    protected $table = 'orders';

    // The attributes that are mass assignable
    protected $fillable = [
        'uuid',
        'cart_id',
        'customer_name',
        'products_name',
        'subtotal_price',
        'tax',
        'shipping_cost',
        'discount',
        'total_price',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    // Cast products_name to an array when retrieving it
    protected $casts = [
        'products_name' => 'array',
    ];

    // Define the relationship with the Cart model (if needed)
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}


