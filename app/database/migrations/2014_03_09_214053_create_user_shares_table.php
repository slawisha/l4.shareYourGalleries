<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserSharesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('user_shares', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('user_share_id')->unsigned();
			$table->foreign('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
			$table->foreign('user_share_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
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
	    Schema::drop('user_shares');
	}

}
