<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
           $table->uuid('id')->primary();
           $table->uuid('order_id');
                  $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
           $table->uuid('product_id');
                  $table->foreign('product_id')->references('id')->on('products');
           $table->integer('qtd');
           $table->double('unit_price');
           $table->double('discount_percentage');
           $table->double('total');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
