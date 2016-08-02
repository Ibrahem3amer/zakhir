<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAblumCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_cat', function(Blueprint $table) {
            $table->integer('ablum_id')->unsigned()->index();
            $table->foreign('ablum_id')->references('id')->on('albums')->onDelete('cascade');

            $table->integer('cat_id')->unsigned()->index();
            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');

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
        //
    }
}
