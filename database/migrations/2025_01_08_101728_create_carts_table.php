<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id')->unique();
            $table->string('uuid')->nullable();
            $table->enum('status', ['waiting', 'pending', 'complete', 'suspended'])->default('waiting');
            // $table->json('items')->nullable(); // Store detailed items data
            $table->decimal('subtotal_price', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}


