<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\UltimatumRole;

class CreateUltimatumRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(UltimatumRole::$TABLE_KEY, function($table)
        {
            $table->increments(UltimatumRole::$ID_KEY);
            $table->integer(UltimatumRole::$SUBJECT_ID_KEY)->unsigned()->default(0);
            $table->integer(UltimatumRole::$PARTNER_SUBJECT_ID_KEY)->unsigned()->default(UltimatumRole::$NO_PARTNER_ID);
            $table->integer(UltimatumRole::$ROLE_KEY)->unsigned();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(UltimatumRole::$TABLE_KEY);
	}

}