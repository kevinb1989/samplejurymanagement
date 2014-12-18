<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJuryToJuriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create some sample juries
		$sampleJury1 = array(
			'FirstName' => 'Kevin',
			'LastName' => 'Bui',
			'Email' => 'hoanglongbui89@yahoo.com.vn',
			'Country' => 'Vietnam'
		);
		$sampleJury2 = array(
			'FirstName' => 'Minh Tien',
			'LastName' => 'Nguyen',
			'Email' => 'minhtien.swin@gmail.com',
			'Country' => 'Vietnam'
		);

		DB::table('juries') -> insert(array($sampleJury1, $sampleJury2));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//revert the changes to the db
		DB::table('juries') -> where('FirstName', 'Kevin') -> orWhere('FirstName', 'Minh Tien') -> delete();
	}

}
