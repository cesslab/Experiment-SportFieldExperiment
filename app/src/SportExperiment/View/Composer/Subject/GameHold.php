<?php namespace SportExperiment\View\Composer\Subject;

use Illuminate\Support\Facades\URL;
use SportExperiment\Controller\Subject\Experiment as ExperimentController;
use SportExperiment\View\Composer\BaseComposer;

class GameHold extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.experiment.game_hold';

    public function compose($view)
    {
        $view->with('gameUrl', URL::to(ExperimentController::getRoute()));
    }
}