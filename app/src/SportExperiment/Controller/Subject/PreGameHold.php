<?php namespace SportExperiment\Controller\Subject;

use SportExperiment\Controller\BaseController;
use Illuminate\Support\Facades\View;
use SportExperiment\View\Composer\Subject\PreGameHold as PreGameHoldComposer;

class PreGameHold extends BaseController {
    private static $URI = 'subject/hold';

    public function __construct()
    {
        View::composer(PreGameHoldComposer::$VIEW_PATH, PreGameHoldComposer::getNamespace());
    }
    public function getHold()
    {
        return View::make(PreGameHoldComposer::$VIEW_PATH);
    }

    public static function getRoute()
    {
        return self::$URI;
    }
}