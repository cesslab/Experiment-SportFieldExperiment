<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\TrustProposerEntry;

class CreateTrustProposerEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(TrustProposerEntry::$TABLE_KEY, function($table)
        {
            $table->increments(TrustProposerEntry::$ID_KEY);
            $table->integer(TrustProposerEntry::$TRUST_ENTRY_ID_KEY)->unsigned();
            $table->double(TrustProposerEntry::$ALLOCATION_KEY);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(TrustProposerEntry::$TABLE_KEY);
	}

}