<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->foreign('cat_id')
                   ->references('id')
                   ->on('cats')
                   ->onDelete('cascade');

            $table->foreign('album_id')
                   ->references('id')
                   ->on('albums')
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
