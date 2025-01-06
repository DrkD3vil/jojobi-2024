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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('categoryid')->unique(); // Unique identifier
            $table->string('category_name'); // Category name
            $table->string('category_barcode')->unique(); // Barcode (unique)
            $table->string('category_barcode_image')->nullable(); // Store barcode image path
            $table->text('category_description')->nullable(); // Description (optional)
            $table->string('category_image')->nullable(); // Image path (optional)
            $table->uuid('uuid')->unique(); // UUID (unique)
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
