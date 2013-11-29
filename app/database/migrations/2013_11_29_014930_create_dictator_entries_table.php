<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\DictatorEntry;

class CreateDictatorEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(DictatorEntry::$TABLE_KEY, function($table)
        {
            $table->increments(DictatorEntry::$ID_KEY);
            $table->integer(DictatorEntry::$SUBJECT_ID_KEY)->unsigned();
            $table->double(DictatorEntry::$DICTATOR_ALLOCATION_KEY)->default(0.0);
            $table->double(DictatorEntry::$PAYOFF_KEY)->default(0.0);
            $table->boolean(DictatorEntry::$SELECTED_FOR_PAYOFF)->default(false);
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
        Schema::drop(DictatorEntry::$TABLE_KEY);
	}

}