<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Model\Eloquent\Subject;
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
            $table->string(Subject::$EDUCATION_KEY)->nullable();
            $table->string(Subject::$GENDER_KEY)->nullable();
            $table->integer(Subject::$AGE_KEY)->nullable();
            $table->string(Subject::$WORK_STATUS_KEY)->nullable();
            $table->string(Subject::$INCOME_KEY)->nullable();

            $table->double(Subject::$PAYOFF_KEY, 5,2)->default(0.0);
            $table->integer(Subject::$PAYOFF_TASK_ID_KEY)->default(0);
            $table->boolean(Subject::$ITEM_PURCHASED_KEY)->default(false);
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