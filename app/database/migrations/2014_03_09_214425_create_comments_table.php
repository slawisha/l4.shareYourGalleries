<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('comments', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->text('body');
			$table->integer('gallery_id')->unsigned();
			$table->integer('user_id')->unsigned();
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
	    Schema::drop('comments');
	}

}
