<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\TrustGroup;

class CreateTrustGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(TrustGroup::$TABLE_KEY, function($table)
        {
            $table->increments(TrustGroup::$ID_KEY);
            $table->integer(TrustGroup::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(TrustGroup::$SUBJECT_ROLE_KEY)->unsigned();
            $table->integer(TrustGroup::$PARTNER_SUBJECT_ID_KEY)->unsigned();
            $table->integer(TrustGroup::$PARTNER_ROLE_KEY)->unsigned();
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
        Schema::drop(TrustGroup::$TABLE_KEY);
	}

}