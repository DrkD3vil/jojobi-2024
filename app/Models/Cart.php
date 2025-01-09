<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected $casts = [
        'items' => 'array', // Automatically cast the JSON column to an array
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
