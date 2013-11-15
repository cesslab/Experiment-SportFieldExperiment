<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\UltimatumEntry;

class CreateUltimatumEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(UltimatumEntry::$TABLE_KEY, function($table)
        {
            $table->increments(UltimatumEntry::$ID_KEY);
            $table->integer(UltimatumEntry::$SUBJECT_ID_KEY)->unsigned();
            $table->double(UltimatumEntry::$AMOUNT_KEY);
            $table->double(UltimatumEntry::$PAYOFF_KEY)->default(0.0);
            $table->double(UltimatumEntry::$PARTNER_AMOUNT_KEY)->default(0.0);
            $table->integer(UltimatumEntry::$PARTNER_ID_KEY)->default(0);
            $table->integer(UltimatumEntry::$PARTNER_ENTRY_KEY)->default(0);
            $table->boolean(UltimatumEntry::$SELECTED_FOR_PAYOFF)->default(false);
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
        Schema::drop(UltimatumEntry::$TABLE_KEY);
	}

}