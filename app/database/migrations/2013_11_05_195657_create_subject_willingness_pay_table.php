<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Subject\WillingnessPay as SubjectWillingnessPay;
use Illuminate\Support\Facades\Schema;

class CreateSubjectWillingnessPayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(SubjectWillingnessPay::$TABLE_KEY, function($table)
        {
            $table->increments(SubjectWillingnessPay::$ID_KEY);
            $table->integer(SubjectWillingnessPay::$SUBJECT_ID_KEY)->unsigned();
            $table->double(SubjectWillingnessPay::$WILLING_PAY_KEY);
            $table->double(SubjectWillingnessPay::$PAYOFF_KEY);
            $table->boolean(SubjectWillingnessPay::$ITEM_PURCHASED_KEY);
            $table->boolean(SubjectWillingnessPay::$SELECTED_FOR_PAYOFF)->default();
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
        Schema::drop(SubjectWillingnessPay::$TABLE_KEY);
	}

}