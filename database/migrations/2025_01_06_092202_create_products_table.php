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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->uuid('product_id')->unique();
            $table->string('product_barcode')->unique(); // Barcode (unique)
            $table->string('product_barcode_image')->nullable(); // Store barcode image path
            $table->string('category_barcode')->nullable(); // Barcode (unique)
            $table->string('category_barcode_image')->nullable(); // Store barcode image path
            $table->string('sku')->unique(); // Stock Keeping Unit
            $table->string('name');
            $table->text('description');
            $table->decimal('original_price', 10, 2); // Original price before discount (if any)
            $table->decimal('buy_price', 10, 2);
            $table->decimal('sell_price', 10, 2);
            $table->decimal('profit_price', 10, 2)->nullable();
            $table->decimal('discount_percentage', 5, 2)->nullable(); // Discount percentage in decimal format (e.g., 10% = 0.10)
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->string('image')->nullable(); // Main product image
            $table->json('image_gallery')->nullable(); // Store multiple images as JSON
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->integer('stock_quantity');
            $table->string('brand'); // Store the brand name
            $table->string('supplier_name')->nullable();
            $table->string('product_type')->nullable(); // e.g., physical, digital, etc.
            $table->date('manufacture_date')->nullable(); // Adds manufacture_date
            $table->date('expire_date')->nullable(); // Adds expire_date
            $table->decimal('weight', 8, 2)->nullable(); // Weight for shipping
            $table->decimal('length', 8, 2)->nullable(); // Product length (for size)
            $table->decimal('width', 8, 2)->nullable(); // Product width (for size)
            $table->decimal('height', 8, 2)->nullable(); // Product height (for size)
            $table->boolean('is_featured')->default(false); // Featured product
            $table->boolean('is_active')->default(true); // Active or inactive status
            $table->timestamps();

            // Foreign key constraint for category
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
