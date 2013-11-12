<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\RiskAversionEntry as SubjectRiskAversion;

class CreateSubjectRiskAversionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(SubjectRiskAversion::$TABLE_KEY, function($table)
        {
            $table->increments(SubjectRiskAversion::$ID_KEY);
            $table->integer(SubjectRiskAversion::$SUBJECT_ID_KEY)->unsigned();
            $table->double(SubjectRiskAversion::$INDIFFERENCE_PROBABILITY_KEY);
            $table->double(SubjectRiskAversion::$PAYOFF_KEY)->default(0.0);
            $table->boolean(SubjectRiskAversion::$SELECTED_FOR_PAYOFF)->default(false);
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
        Schema::drop(SubjectRiskAversion::$TABLE_KEY);
	}

}