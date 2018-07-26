<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
           $table->uuid('id')->primary();
           $table->uuid('consumer_id')->index();
              $table->foreign('consumer_id')->references('id')->on('consumer');

            $table->increments('number');//auto incremento
           $table->date('emission_date');
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
        Schema::dropIfExists('orders');
    }
}