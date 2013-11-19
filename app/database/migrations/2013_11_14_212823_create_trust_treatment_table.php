<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\TrustTreatment;

class CreateTrustTreatmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(TrustTreatment::$TABLE_KEY, function($table)
        {
            $table->increments(TrustTreatment::$ID_KEY);
            $table->integer(TrustTreatment::$SESSION_ID_KEY)->unsigned();
            $table->double(TrustTreatment::$PROPOSER_ALLOCATION_MULTIPLIER_KEY);
            $table->double(TrustTreatment::$RECEIVER_ALLOCATION_MULTIPLIER_KEY);
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
        Schema::drop(TrustTreatment::$TABLE_KEY);
	}

}