<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('cat_id')
                   ->references('id')
                   ->on('cats')
                   ->onDelete('cascade');

            $table->foreign('photo_id')
                   ->references('id')
                   ->on('photos')
                   ->onDelete('cascade');

            $table->foreign('sub_cat_id')
                   ->references('id')
                   ->on('sub_cats')
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
        //
    }
}
