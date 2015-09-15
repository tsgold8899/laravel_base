<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emails', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('subject');
			$table->text('content');
			$table->string('notes')->nullable();
			$table->timestamps();
		});

		DB::table('emails')->insert(array(
			'name' => 'Enrolment confirmation email',
			'subject' => 'Your training enrolment with the RRRR',
			'content' => 'Some sample email content',
			'notes' => 'Email sent upon successful registration',
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
		Schema::drop('emails');
	}

}
