<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnabledToJuriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//add the column Enabled to juries table
		Schema::table('juries', function($table){
			$table -> boolean('Enabled') -> nullable() -> default(true) -> after('TotalVotedApps');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//drop column enabled
		Schema::table('juries', function($table){
			$table -> drop_column('enabled');
		});
	}

}
