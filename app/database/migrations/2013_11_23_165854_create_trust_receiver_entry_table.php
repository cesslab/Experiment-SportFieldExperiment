<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\TrustReceiverEntry;

class CreateTrustReceiverEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(TrustReceiverEntry::$TABLE_KEY, function($table)
        {
            $table->increments(TrustReceiverEntry::$ID_KEY);
            $table->integer(TrustReceiverEntry::$TRUST_ENTRY_ID_KEY)->unsigned();
            $table->double(TrustReceiverEntry::$PROPOSER_ALLOCATION_KEY);
            $table->double(TrustReceiverEntry::$ALLOCATION_KEY);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(TrustReceiverEntry::$TABLE_KEY);
	}

}