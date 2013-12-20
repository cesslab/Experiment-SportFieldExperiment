<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\Charity;

class CreateCharityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(Charity::$TABLE_KEY, function($table)
        {
            $table->increments(Charity::$ID_KEY);
            $table->integer(Charity::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(Charity::$CHARITY_KEY)->unsigned();
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
        Schema::drop(Charity::$TABLE_KEY);
	}

}