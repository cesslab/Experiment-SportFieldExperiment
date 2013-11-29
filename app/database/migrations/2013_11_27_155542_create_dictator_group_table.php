<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\DictatorGroup;

class CreateDictatorGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(DictatorGroup::$TABLE_KEY, function($table)
        {
            $table->increments(DictatorGroup::$ID_KEY);
            $table->integer(DictatorGroup::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(DictatorGroup::$SUBJECT_ROLE_KEY)->unsigned();
            $table->integer(DictatorGroup::$PARTNER_SUBJECT_ID_KEY)->unsigned();
            $table->integer(DictatorGroup::$PARTNER_ROLE_KEY)->unsigned();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(DictatorGroup::$TABLE_KEY);
	}
}