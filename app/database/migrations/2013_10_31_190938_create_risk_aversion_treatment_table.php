<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use Illuminate\Support\Facades\Schema;

class CreateRiskAversionTreatmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(RiskAversionTreatment::$TABLE_KEY, function($table)
		{
            $table->increments(RiskAversionTreatment::$ID_KEY);
            $table->integer(RiskAversionTreatment::$TASK_ID_KEY)->unsigned();
			$table->integer(RiskAversionTreatment::$SESSION_ID_KEY)->unsigned();
            $table->double(RiskAversionTreatment::$ENDOWMENT_KEY);
            $table->double(RiskAversionTreatment::$LOW_PRIZE_KEY);
            $table->double(RiskAversionTreatment::$HIGH_PRIZE_KEY);
            $table->double(RiskAversionTreatment::$PRIZE_PROBABILITY_KEY);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(RiskAversionTreatment::$TABLE_KEY);
	}

}