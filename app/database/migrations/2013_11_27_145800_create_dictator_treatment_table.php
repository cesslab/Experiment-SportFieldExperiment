<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\DictatorTreatment;

class CreateDictatorTreatmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(DictatorTreatment::$TABLE_KEY, function($table)
        {
            $table->increments(DictatorTreatment::$ID_KEY);
            $table->integer(DictatorTreatment::$SESSION_ID_KEY)->unsigned();
            $table->double(DictatorTreatment::$PROPOSER_ENDOWMENT_KEY);
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
        Schema::drop(DictatorTreatment::$TABLE_KEY);
	}
}