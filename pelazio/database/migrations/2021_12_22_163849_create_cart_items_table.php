<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('cart_id')
                ->references('id')
                ->on('carts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
