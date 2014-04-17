<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tags', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->integer('gallery_id')->unsigned();
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
	    Schema::drop('tags');
	}

}
