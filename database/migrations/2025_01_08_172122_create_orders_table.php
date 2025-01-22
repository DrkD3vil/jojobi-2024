<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->uuid('uuid')->unique(); // Generate a unique UUID for each order
            $table->string('cart_id');
            // $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade'); // Foreign key for cart
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Foreign key for customer
            $table->json('product_name'); // Store product names from cart_items (array of product names)
            $table->json('quantity'); // Store quantities (array of quantities)
            $table->decimal('subtotal', 10, 2); // Cart subtotal
            $table->decimal('tax', 5, 2)->nullable(); // Tax percentage
            $table->decimal('shipping_cost', 10, 2)->nullable(); // Shipping cost
            $table->decimal('discount', 5, 2)->nullable(); // Discount percentage
            $table->decimal('flat_discount', 10, 2)->nullable(); // Flat discount amount
            $table->decimal('total', 10, 2); // Total after tax, discount, and shipping
            $table->decimal('round_total', 10, 2); // Rounded total
            $table->enum('status', ['pending', 'complete', 'suspended'])->default('pending'); // Order status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
