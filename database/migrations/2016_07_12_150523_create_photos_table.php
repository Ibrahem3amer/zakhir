<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->integer('sub_cat_id')->nullable()->unsigned();
            $table->integer('album_id')->nullable()->unsigned();
            $table->integer('views');
            $table->string('title');
            $table->string('photo_url');
            $table->string('description');
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
        Schema::drop('photos');
    }
}
