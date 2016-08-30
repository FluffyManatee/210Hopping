<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('bars', function (Blueprint $table) {
			$table->increments('id');
			$table->string('type');
			$table->string('name')->unique();
			$table->string('address');
			$table->integer('phone')->nullable();;
			$table->string('website')->nullable();;
			$table->string('email')->nullable();;
			$table->boolean('owner');
			$table->integer('owner_id')->unsigned()->nullable();;
			$table->foreign('owner_id')->references('id')->on('users');
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
        Schema::drop('bars');
    }
}
