<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'invoice_barcode',
        'invoice_barcode_image',
        'order_id',
        'customer_id',
        'transation_id',
        'payment_id',
        'subtotal',
        'tax',
        'shipping_cost',
        'discount',
        'total',
        'paid_amount',
        'change_amount',
        'payment_method',
        'payment_status',
    ];
        // Define the relationship with the Order model
        public function order()
        {
            return $this->belongsTo(Order::class, 'order_id', 'id');
        }
    
        // Define the relationship with the Customer model
        public function customer()
        {
            return $this->belongsTo(Customer::class, 'customer_id', 'id');
        }

        // Define the relationship with the Transection model
        public function transaction()
        {
            return $this->belongsTo(Transaction::class,'transation_id', 'id');
        }
        public function payment()
        {
            return $this->belongsTo(Payment::class,'payment_id', 'id');
        }
}
