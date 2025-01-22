<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'order_id',
        'customer_barcode',
        'order_total_amount',
        'customer_due',
        'customer_advance',
        'total_amount',
        'payment_status',
        'transaction_date',
    ];

    // public function payments()
    // {
    //     return $this->hasMany(Payment::class);
    // }

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_barcode', 'barcode_number');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
