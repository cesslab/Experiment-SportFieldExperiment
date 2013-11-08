<?php namespace SportExperiment\View\Composer\Subject;

use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Subject\PreGameHold as PreGameHoldController;
use Illuminate\Support\Facades\URL;

class PreGameHold extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.experiment.hold';

    public function compose($view)
    {
        $view->with('holdScreenUrl', URL::to(PreGameHoldController::getRoute()));
    }
}