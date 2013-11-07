<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Subject;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(Subject::$TABLE_KEY, function($table){
            $table->increments(Subject::$ID_KEY);
            $table->integer(Subject::$SESSION_ID_KEY)->unsigned();
            $table->integer(Subject::$USER_ID_KEY)->unsigned();

            $table->integer(Subject::$GAME_STATE_KEY);

            $table->string(Subject::$FIRST_NAME_KEY)->nullable();
            $table->string(Subject::$LAST_NAME_KEY)->nullable();
            $table->string(Subject::$PROFESSION_KEY)->nullable();
            $table->string(Subject::$EDUCATION_KEY)->nullable();
            $table->string(Subject::$GENDER_KEY)->nullable();
            $table->integer(Subject::$AGE_KEY)->nullable();
            $table->string(Subject::$ETHNICITY_KEY)->nullable();
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
        Schema::drop(Subject::$TABLE_KEY);
	}

}