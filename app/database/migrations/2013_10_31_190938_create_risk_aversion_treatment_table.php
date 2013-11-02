<?php

use Illuminate\Database\Migrations\Migration;

class CreateRiskAversionTreatmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('risk_aversion_treatment', function($table)
		{
			$table->string('id')->unique();
			$table->integer('session_id')->unsigned();
            $table->integer('low_prize');
            $table->integer('mid_prize');
            $table->integer('high_prize');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('risk_aversion_treatment');
	}

}