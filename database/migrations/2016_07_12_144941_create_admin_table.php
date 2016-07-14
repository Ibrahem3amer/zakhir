<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function(Blueprint $table){
            $table->increments('id');
            $table->boolean('super');
            $table->integer('user_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('admins', function(Blueprint $table){
            $table->foreign('user_id')
                   ->references('id')->on('users')
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
        Schema::drop('admins');
    }
}
