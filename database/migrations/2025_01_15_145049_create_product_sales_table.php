<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();  // Unique identifier for the sale record
            $table->string('order_id') ;  // Link to the order
            $table->string('cart_id') ;  // Link to the cart
            $table->string('cart_item_id');  // Link to the cart item
            $table->string('product_id');  // Link to the product
            $table->string('payment_id');  // Link to the payment record
            $table->string('transaction_id')->nullable();  // Transaction ID from payment gateway
            $table->string('supplier_id')->nullable(); 
            $table->integer('quantity');  // Quantity of the product sold
            $table->decimal('sell_price', 10, 2);  // Sale price of the product
            $table->decimal('buy_price', 10, 2);  // Purchase price (cost price) of the product
            $table->decimal('total_sell_price', 10, 2);  // Total revenue from this product (sell_price * quantity)
            $table->decimal('total_buy_price', 10, 2);  // Total cost from this product (buy_price * quantity)
            $table->decimal('profit', 10, 2);  // Profit from this sale (total_sell_price - total_buy_price)
            $table->decimal('margin', 5, 2);  // Profit margin percentage ((profit / total_sell_price) * 100)
            $table->date('sale_date');  // Date of the sale
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sales');
    }
};
