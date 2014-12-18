<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriptionToJuriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//add subscription column to juries table
		Schema::table('juries', function($table){
			$table -> integer('subscription') -> after('Enabled');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//drop subscription column
		Schema::table('juries', function($table){
			$table -> drop_column('subscription');
		});
	}

}
