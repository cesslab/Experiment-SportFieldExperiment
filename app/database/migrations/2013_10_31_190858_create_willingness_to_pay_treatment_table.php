<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
use Illuminate\Support\Facades\Schema;

class CreateWillingnessToPayTreatmentTable extends Migration {


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(WillingnessPayTreatment::$TABLE_KEY, function($table)
		{
            $table->increments(WillingnessPayTreatment::$ID_KEY);
            $table->integer(WillingnessPayTreatment::$TASK_ID_KEY)->unsigned();
			$table->integer(WillingnessPayTreatment::$SESSION_ID_KEY)->unsigned();
            $table->double(WillingnessPayTreatment::$ENDOWMENT_KEY);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(WillingnessPayTreatment::$TABLE_KEY);
	}
}