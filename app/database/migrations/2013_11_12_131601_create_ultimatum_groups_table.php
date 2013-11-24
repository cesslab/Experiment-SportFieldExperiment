<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\UltimatumGroup;

class CreateUltimatumGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(UltimatumGroup::$TABLE_KEY, function($table)
        {
            $table->increments(UltimatumGroup::$ID_KEY);
            $table->integer(UltimatumGroup::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(UltimatumGroup::$SUBJECT_ROLE_KEY)->unsigned();
            $table->integer(UltimatumGroup::$PARTNER_SUBJECT_ID_KEY)->unsigned();
            $table->integer(UltimatumGroup::$PARTNER_ROLE_KEY)->unsigned();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(UltimatumGroup::$TABLE_KEY);
	}

}