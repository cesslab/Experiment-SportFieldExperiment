<?php

use Illuminate\Database\Migrations\Migration;

class CreateWillingnessToPayTreatmentTable extends Migration {


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('willingness_to_pay_treatment', function($table)
		{
			$table->string('id')->unique();
			$table->integer('session_id')->unsigned();
            $table->integer('endowment');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('willingness_to_pay_treatment');
	}
}