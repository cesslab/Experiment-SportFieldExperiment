<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;

class CreateRiskAversionTreatmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(RiskAversion::$TABLE_KEY, function($table)
		{
			$table->string(RiskAversion::$ID_KEY)->unique();
			$table->integer(RiskAversion::$SESSION_ID_KEY)->unsigned();
            $table->integer(RiskAversion::$LOW_PRIZE_KEY);
            $table->integer(RiskAversion::$MID_PRIZE_KEY);
            $table->integer(RiskAversion::$LOW_PRIZE_KEY);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(RiskAversion::$TABLE_KEY);
	}

}