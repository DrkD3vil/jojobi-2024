<?php

// app/Models/Payment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'transaction_id',
        'payment_method',
        'total_amount',
        'payment_amount',
        'change_amount',
        'payment_status',
        'payment_date',
    ];

    // Define relationship with the transaction table
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
