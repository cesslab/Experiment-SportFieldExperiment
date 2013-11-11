<?php namespace SportExperiment\Controller\Subject;

use Illuminate\Support\Facades\View;
use SportExperiment\Controller\BaseController;
use SportExperiment\View\Composer\Subject\Completed as CompletedComposer;

class Completed extends BaseController
{
    public static $URI = 'subject/experiment/completed';

    public function getCompleted()
    {
        return View::make(CompletedComposer::$VIEW_PATH);
    }

    public static function getRoute()
    {
        return self::$URI;
    }
}