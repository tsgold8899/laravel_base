<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVenueRegionId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('venues', function($table) {

			$table->unsignedInteger('region_id')->nullable();
			$table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('venues', function($table)
		{
			$table->dropForeign('venues_region_id_foreign');
		    $table->dropColumn('region_id');
		});
	}

}
