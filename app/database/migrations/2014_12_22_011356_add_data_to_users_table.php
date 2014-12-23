<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//add users to users table
		$user1 = array(
			'fullname' => 'Kevin Bui',
			'email' => 'kevin@instani.com',
			'password' => '12345678'
		);
		$user2 = array(
			'fullname' => 'Srikanth Puluru',
			'email' => 'srikanth@instani.com',
			'password' => '12345678'
		);
		$user3 = array(
			'fullname' => 'Yogi Patel',
			'email' => 'yogesh@instani.com',
			'password' => '12345678'
		);
		$user4 = array(
			'fullname' => 'Afzal Ahmad',
			'email' => 'afzal@instani.com',
			'password' => '12345678'
		);
		$user5 = array(
			'fullname' => 'Darsana Usha',
			'email' => 'darsana@instani.com',
			'password' => '12345678'
		);

		DB::table('users') -> insert(array($user1, $user2, $user3, $user4, $user5));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//delete those users
		DB::table('users')
			-> where('email', 'kevin@instani.com')
			-> orWhere('email', 'srikanth@instani.com')
			-> orWhere('email', 'yogesh@instani.com')
			-> orWhere('email', 'afzal@instani.com')
			-> orWhere('email' , 'darsana@instani.com')
			-> delete();
	}

}
