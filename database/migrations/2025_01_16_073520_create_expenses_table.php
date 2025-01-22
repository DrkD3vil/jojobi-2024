<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->uuid('uuid')->unique(); // Unique identifier
            $table->string('type'); // Type of expense (e.g., office, travel)
            $table->decimal('amount', 15, 2); // Amount with precision for currency
            $table->text('note')->nullable(); // Additional notes
            $table->date('date'); // Expense date
            $table->string('category')->nullable(); // Optional category field
            $table->unsignedBigInteger('user_id')->nullable(); // Associated user ID if applicable
            $table->string('image')->nullable(); // New image field, nullable
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
