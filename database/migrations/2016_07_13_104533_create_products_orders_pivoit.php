<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsOrdersPivoit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('order_id')
                   ->references('id')
                   ->on('orders')
                   ->onDelete('cascade');

            $table->foreign('product_id')
                   ->references('id')
                   ->on('products')
                   ->onDelete('cascade');

            $table->foreign('user_id')
                   ->references('id')
                   ->on('users')
                   ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders_products');
    }
}
