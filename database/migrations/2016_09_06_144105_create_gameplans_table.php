<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameplans', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->date('date');
            $table->integer('bar1_id')->unsigned();
            $table->integer('bar2_id')->unsigned()->nullable();
            $table->integer('bar3_id')->unsigned()->nullable();
            $table->integer('bar4_id')->unsigned()->nullable();
            $table->integer('bar5_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('bar1_id')->references('id')->on('bars');
            $table->foreign('bar2_id')->references('id')->on('bars');
            $table->foreign('bar3_id')->references('id')->on('bars');
            $table->foreign('bar4_id')->references('id')->on('bars');
            $table->foreign('bar5_id')->references('id')->on('bars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gameplans');
    }
}
