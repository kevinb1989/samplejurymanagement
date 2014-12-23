<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create users
		schema::create('users', function($table){
			$table -> increments('id');
			$table -> string('fullname');
			$table -> string('email');
			$table -> string('password');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//drop users table
		Schema::drop('users');
	}

}
