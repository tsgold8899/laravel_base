<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSampleRegions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::table('regions')->insert(array(
			'name' => 'Adelaide metro area',
			'created_at' => date('Y-m-d H:m:s'),
			'updated_at' => date('Y-m-d H:m:s')
		));

		DB::table('regions')->insert(array(
			'name' => 'Murray Bridge',
			'created_at' => date('Y-m-d H:m:s'),
			'updated_at' => date('Y-m-d H:m:s')
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		DB::table('regions')->where('name', '=', 'Adelaide metro area')->delete();
		DB::table('regions')->where('name', '=', 'Murray Bridge')->delete();
	}

}
