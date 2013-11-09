<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Schema;
use SportExperiment\Repository\Eloquent\Subject\RiskAversion as SubjectRiskAversion;

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
            $table->double(SubjectRiskAversion::$PAYOFF_KEY);
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