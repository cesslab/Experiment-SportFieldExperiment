<?php namespace SportExperiment\Controller\Subject;

use SportExperiment\Controller\BaseController;
use Illuminate\Support\Facades\View;

class PreGameHold extends BaseController {
    public static $URI = 'subject/hold';

    public function getHold()
    {
        return View::make('site.subject.experiment.hold');
    }
}