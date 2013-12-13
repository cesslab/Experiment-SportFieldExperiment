<?php namespace SportExperiment\View\Composer\Subject\PreGame;

use SportExperiment\Model\NFLTeams;
use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Subject\PreGame\Questionnaire as PreGameQuestionnaireController;
use SportExperiment\Model\Eloquent\PreGameQuestionnaire as PreGameQuestionnaireModel;
use Illuminate\Support\Facades\URL;

class Questionnaire extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.pregame.questionnaire';

    public function compose($view)
    {
        $view->with('postUrl', URL::to(PreGameQuestionnaireController::getRoute()));

        $view->with('sportFan', PreGameQuestionnaireModel::$SPORT_FAN_KEY);
        $view->with('sportFanOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], PreGameQuestionnaireModel::getOptionRange()));

        $view->with('footballFan', PreGameQuestionnaireModel::$FOOTBALL_FAN_KEY);
        $view->with('footballFanOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], PreGameQuestionnaireModel::getOptionRange()));

        $view->with('favoriteTeam', PreGameQuestionnaireModel::$FAVORITE_TEAM_KEY);
        $view->with('favoriteTeamOptions', array_merge([0=>'I do not have a favorite team.', 'default'=>'Select A Team'], NFLTeams::getNFLTeams()));

        $view->with('favoredTeam', PreGameQuestionnaireModel::$FAVORED_TEAM_KEY);
        $view->with('favoredTeamOptions', array_merge([0=>'I am not rooting for any teams today.', 'default'=>'Select A Team'], NFLTeams::getNFLTeams()));

        $view->with('measureFavoredTeam', PreGameQuestionnaireModel::$MEASURE_FAVORED_TEAM_KEY);
        $view->with('measureFavoredTeamOptions', array_merge(['default'=>'Select A Number Between 1 and 7'], PreGameQuestionnaireModel::getOptionRange()));
    }

} 