<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // Unique identifier
            $table->string('supplier_id')->unique(); // Custom supplier ID
            $table->string('supplier_name');
            $table->string('supplier_barcode')->unique();
            $table->string('supplier_image')->nullable(); // Path to supplier image
            $table->decimal('amount', 15, 2)->default(0); // Total transaction amount
            $table->decimal('paid', 15, 2)->default(0); // Amount paid
            $table->decimal('due', 15, 2)->default(0); // Due amount
            $table->text('note')->nullable(); // Additional notes
            $table->string('status')->default('active'); // Status (e.g., active, inactive)
            $table->string('email')->nullable(); // Supplier email
            $table->string('phone')->nullable(); // Supplier phone
            $table->string('address')->nullable(); // Supplier address
            $table->unsignedBigInteger('created_by')->nullable(); // User who created the record
            $table->unsignedBigInteger('updated_by')->nullable(); // User who last updated the record
            $table->timestamps();
            
            // Optional: Foreign keys to users table for created_by and updated_by
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};
