<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarPicturesTable extends Migration
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
			$table->integer('bar_id')->unsigned();
			$table->foreign('bar_id')->references('id')->on('bars');
			$table->string('pic_file');
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
