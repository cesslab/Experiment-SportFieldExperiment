<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\Good;

class CreateGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(Good::$TABLE_KEY, function($table)
        {
            $table->increments(Good::$ID_KEY);
            $table->integer(Good::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(Good::$GOOD_KEY)->unsigned();
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
        Schema::drop(Good::$TABLE_KEY);
	}

}