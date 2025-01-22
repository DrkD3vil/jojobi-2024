<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->unique();
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->enum('payment_method', ['cash', 'credit_card', 'bank_transfer', 'mobile_money']);  // Payment method
            $table->decimal('total_amount', 10, 2);  // Total amount
            $table->decimal('payment_amount', 10, 2);  // Amount paid by the customer
            $table->decimal('change_amount', 10, 2);   // Amount changed by the customer
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');  // Payment status
            $table->timestamp('payment_date')->default(DB::raw('CURRENT_TIMESTAMP'));  // Timestamp of the payment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
