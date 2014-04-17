<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('galleries', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->text('description')->nullable();
			$table->text('url');
			$table->integer('user_id')->unsigned();
			$table->integer('rating')->nullable();
			$table->timestamps('');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('galleries');
	}

}
