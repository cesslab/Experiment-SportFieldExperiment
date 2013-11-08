<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Session;
use Illuminate\Support\Facades\Schema;

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
            $table->increments(Session::$ID_KEY);
			$table->integer(Session::$NUM_SUBJECTS_KEY);
            $table->integer(Session::$STATE_KEY);
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
		Schema::drop(Session::$TABLE_KEY);
	}

}