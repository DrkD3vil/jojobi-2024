<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateShopLogosTable extends Migration
{
    public function up()
    {
        Schema::create('shop_logos', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->uuid('uuid')->default(Str::uuid()); // UUID for the record
            $table->string('name'); // Name of the shop
            $table->string('image'); // Path to the uploaded logo image
            $table->string('uploaded_by'); // The username of the user who uploaded the image
            $table->text('notes')->nullable(); // Any additional notes related to the logo
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('shop_logos');
    }
}