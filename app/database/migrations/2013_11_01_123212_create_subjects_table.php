<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\Subject;

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
            $table->string(Subject::$USER_ID_KEY);
            $table->string(Subject::$FIRST_NAME_KEY);
            $table->string(Subject::$LAST_NAME_KEY);
            $table->string(Subject::$PROFESSION_KEY);
            $table->string(Subject::$EDUCATION_KEY);
            $table->string(Subject::$GENDER_KEY);
            $table->integer(Subject::$AGE_KEY)->unsigned();
            $table->string(Subject::$ETHNICITY_KEY);
            $table->boolean(Subject::$ACTIVE_KEY)->default(false);
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