<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Bookmarks table
		Schema::create('bookmarks', function($table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('url');
            $table->timestamp('last_visited_at')->nullable();
            $table->bigInteger('visited_count')->default(0);
            $table->timestamps();
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
		Schema::drop('bookmarks');
	}

}
