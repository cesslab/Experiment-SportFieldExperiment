<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\TrustEntry;

class CreateTrustEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(TrustEntry::$TABLE_KEY, function($table)
        {
            $table->increments(TrustEntry::$ID_KEY);
            $table->integer(TrustEntry::$SUBJECT_ID_KEY)->unsigned();
            $table->double(TrustEntry::$PAYOFF_KEY)->default(0.0);
            $table->boolean(TrustEntry::$SELECTED_FOR_PAYOFF)->default(false);
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
        Schema::drop(TrustEntry::$TABLE_KEY);
	}

}