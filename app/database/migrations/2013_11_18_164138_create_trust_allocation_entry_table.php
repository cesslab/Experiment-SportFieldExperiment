<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\TrustAllocationEntry;

class CreateTrustAllocationEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(TrustAllocationEntry::$TABLE_KEY, function($table)
        {
            $table->increments(TrustAllocationEntry::$ID_KEY);
            $table->integer(TrustAllocationEntry::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(TrustAllocationEntry::$TRUST_ENTRY_ID_KEY)->unsigned();
            $table->integer(TrustAllocationEntry::$ALLOCATION_ID_KEY)->unsigned();
            $table->double(TrustAllocationEntry::$ALLOCATION_KEY);
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
        Schema::drop(TrustAllocationEntry::$TABLE_KEY);
	}

}