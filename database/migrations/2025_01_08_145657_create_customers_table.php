<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable(); // Fixed syntax (removed the extra `->`)
            $table->string('image')->nullable();
            $table->string('barcode_number')->unique();
            $table->string('barcode_image')->nullable();
            $table->decimal('advance_amount', 10, 2)->default(0); // Track advance amount
            $table->decimal('due_amount', 10, 2)->default(0); // Track due amount
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}

