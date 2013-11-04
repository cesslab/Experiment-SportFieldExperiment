<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Session;

class CreateExperimentSessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(Session::$TABLE_KEY, function($table)
		{
			$table->string(Session::$ID_KEY)->unique();
			$table->integer(Session::$NUM_SUBJECTS_KEY);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(Session::$TABLE_KEY);
	}

}