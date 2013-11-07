<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;
use Illuminate\Support\Facades\Schema;

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
            $table->increments(RiskAversion::$ID_KEY);
			$table->integer(RiskAversion::$SESSION_ID_KEY)->unsigned();
            $table->double(RiskAversion::$LOW_PRIZE_KEY);
            $table->double(RiskAversion::$MID_PRIZE_KEY);
            $table->double(RiskAversion::$HIGH_PRIZE_KEY);
            $table->double(RiskAversion::$GAMBLE_PROBABILITY_KEY);
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