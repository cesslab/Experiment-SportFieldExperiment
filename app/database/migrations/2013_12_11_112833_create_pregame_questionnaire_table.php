<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\PreGameQuestionnaire;

class CreatePregameQuestionnaireTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(PreGameQuestionnaire::$TABLE_KEY, function($table){
            $table->increments(PreGameQuestionnaire::$ID_KEY);
            $table->integer(PreGameQuestionnaire::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(PreGameQuestionnaire::$SPORT_FAN_KEY)->unsigned();
            $table->integer(PreGameQuestionnaire::$FOOTBALL_FAN_KEY)->unsigned();
            $table->string(PreGameQuestionnaire::$FAVORITE_TEAM_KEY);
            $table->string(PreGameQuestionnaire::$FAVORED_TEAM_KEY);
            $table->integer(PreGameQuestionnaire::$MEASURE_FAVORED_TEAM_KEY)->unsigned();
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
        Schema::drop(PreGameQuestionnaire::$TABLE_KEY);
	}

}