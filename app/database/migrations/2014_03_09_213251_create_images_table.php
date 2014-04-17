<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('images', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
			$table->string('url');
			$table->integer('order')->nullable();
			$table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
			$table->timestamps('');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('images');
	}

}
