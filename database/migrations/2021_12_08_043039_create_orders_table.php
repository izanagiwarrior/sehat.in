<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->unsignedInteger('id_product');
            $table->unsignedInteger('id_checkout');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_product')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_checkout')
                ->references('id')
                ->on('checkouts')
                ->onDelete('cascade')->onUpdate('cascade');
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
