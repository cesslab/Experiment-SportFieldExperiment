<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Researcher;
use Illuminate\Support\Facades\Schema;

class CreateResearcherTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(Researcher::$TABLE_KEY, function($table) {
            $table->increments(Researcher::$ID_KEY);
            $table->integer(Researcher::$USER_ID_KEY);
            $table->string(Researcher::$FIRST_NAME_KEY);
            $table->string(Researcher::$LAST_NAME_KEY);
            $table->string(Researcher::$EMAIL_KEY);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(Researcher::$TABLE_KEY);
	}

}