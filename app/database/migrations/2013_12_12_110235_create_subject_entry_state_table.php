<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\SubjectEntryState;

class CreateSubjectEntryStateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(SubjectEntryState::$TABLE_KEY, function($table){
            $table->increments(SubjectEntryState::$ID_KEY);
            $table->integer(SubjectEntryState::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(SubjectEntryState::$CURRENT_TASK_ID_KEY)->unsigned()->default(0);
            $table->boolean(SubjectEntryState::$TASKS_COMPLETED_KEY)->default(false);
            $table->boolean(SubjectEntryState::$QUESTIONS_COMPLETED_KEY)->default(false);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(SubjectEntryState::$TABLE_KEY);
	}

}