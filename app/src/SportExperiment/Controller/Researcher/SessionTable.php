<?php namespace SportExperiment\Controller\Researcher;

use Illuminate\Support\Facades\View;
use SportExperiment\Controller\BaseController;
use SportExperiment\View\Composer\Researcher\SessionTable as SessionTableComposer;

class SessionTable extends BaseController
{
    private static $URI = 'researcher/subject_table';

    public function __construct()
    {
        View::composer(SessionTableComposer::$VIEW_PATH, SessionTableComposer::getNamespace());
    }

    public function getSessionTable()
    {
        return View::make(SessionTableComposer::$VIEW_PATH);
    }

    public static function getRoute()
    {
        return self::$URI;
    }
}