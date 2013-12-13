<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\GameQuestionnaire;

class CreateGameQuestionnaireTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(GameQuestionnaire::$TABLE_KEY, function($table){
            $table->increments(GameQuestionnaire::$ID_KEY);
            $table->integer(GameQuestionnaire::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(GameQuestionnaire::$LEVEL_SURPRISE_KEY)->unsigned();
            $table->integer(GameQuestionnaire::$LEVEL_EXCITATION_KEY)->unsigned();
            $table->integer(GameQuestionnaire::$LEVEL_HAPPINESS_KEY)->unsigned();
            $table->integer(GameQuestionnaire::$LIKELINESS_WINNING_KEY)->unsigned();
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
        Schema::drop(GameQuestionnaire::$TABLE_KEY);
    }

}