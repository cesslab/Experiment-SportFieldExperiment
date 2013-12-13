<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\UltimatumTreatment;

class CreateUltimatumTreatmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(UltimatumTreatment::$TABLE_KEY, function($table)
        {
            $table->increments(UltimatumTreatment::$ID_KEY);
            $table->integer(UltimatumTreatment::$TASK_ID_KEY)->unsigned();
            $table->integer(UltimatumTreatment::$SESSION_ID_KEY)->unsigned();
            $table->double(UltimatumTreatment::$TOTAL_AMOUNT_KEY);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(UltimatumTreatment::$TABLE_KEY);
	}

}