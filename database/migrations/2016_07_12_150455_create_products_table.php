<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->integer('count');
            $table->double('price');
            $table->string('name');
            $table->boolean('status');
            $table->boolean('has_sale');
            $table->string('photo_url')->nullable();
            $table->integer('photo_id')->nullable()->unsigned();
            //$table->json('colors');
            //$table->json('sizes');
            $table->rememberToken();
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
        Schema::drop('products');
    }
}
