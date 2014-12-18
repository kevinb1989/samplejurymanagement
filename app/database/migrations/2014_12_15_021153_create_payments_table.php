<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//generate payments table
		Schema::create('payments', function($table){
			$table -> increments('id');
			$table -> string('txn_id', 150);
			$table -> integer('jury_id') -> unsigned();
			$table -> foreign('jury_id') -> references('id') -> on('juries');
			$table -> string('paypal_id', 150);
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
		//drop payments table
		Schema::drop('payments');
	}

}
