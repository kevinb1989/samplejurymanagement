<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create juries table
		Schema::create('juries', function($table){
			$table -> increments('id');
			$table -> string('FirstName', 50);
			$table -> string('LastName', 50);
			$table -> string('Email',100);
			$table -> string('Country',100);
			$table -> integer('TotalVotedApps') -> nullable();
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
		//drop the juries table
		Schema::drop('juries');
	}

}
