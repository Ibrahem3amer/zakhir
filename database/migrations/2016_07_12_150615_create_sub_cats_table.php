<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id');
            $table->string('name');
            $table->rememberToken();
            $table->timestamps();    

        }); 

        Schema::table('sub_cats', function (Blueprint $table) {
            $table->foreign('cat_id')
                   ->references('id')
                   ->on('cats')
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
        Schema::drop('sub_cats');
    }
}
