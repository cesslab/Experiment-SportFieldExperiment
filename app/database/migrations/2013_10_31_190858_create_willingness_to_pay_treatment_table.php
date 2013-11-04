<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;

class CreateWillingnessToPayTreatmentTable extends Migration {


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(WillingnessPay::$TABLE_KEY, function($table)
		{
			$table->string(WillingnessPay::$ID_KEY)->unique();
			$table->integer(WillingnessPay::$SESSION_ID_KEY)->unsigned();
            $table->integer(WillingnessPay::$ENDOWMENT_KEY);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(WillingnessPay::$TABLE_KEY);
	}
}