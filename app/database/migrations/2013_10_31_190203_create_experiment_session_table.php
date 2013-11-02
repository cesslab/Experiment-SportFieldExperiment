<?php

use Illuminate\Database\Migrations\Migration;

class CreateExperimentSessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('experiment_sessions', function($table)
		{
			$table->string('id')->unique();
			$table->integer('num_subjects');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('experiment_sessions');
	}

}