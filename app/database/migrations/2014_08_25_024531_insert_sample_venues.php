<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSampleVenues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::table('venues')->insert(array(
			'name' => 'Adelaide Aquatic Centre',
			'address' => 'Jeffcott Rd, Adelaide SA 5006',
			'created_at' => date('Y-m-d H:m:s'),
			'updated_at' => date('Y-m-d H:m:s')
		));

		DB::table('venues')->insert(array(
			'name' => 'Royal Life Saving SA Offices',
			'address' => '175 Sir Donald Bradman Drive, Cowandilla SA 5033',
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
		DB::table('venues')->where('name', '=', 'Adelaide Aquatic Centre')->delete();
		DB::table('venues')->where('name', '=', 'Royal Life Saving SA Offices')->delete();
	}

}
