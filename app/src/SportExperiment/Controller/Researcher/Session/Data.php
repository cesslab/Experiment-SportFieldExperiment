<?php namespace SportExperiment\Controller\Researcher\Session;

use SportExperiment\Controller\BaseController;
use SportExperiment\Model\Eloquent\Session as SessionModel;

class Data extends BaseController
{
    private static $URI = 'researcher/session/{session_id}';
    private static $SESSION_ID_KEY = 'session_id';

    public function __construct()
    {
    }

    public function getSessionData(SessionModel $session)
    {
        return $session->subjects;
    }

    public static function getSessionIdKey()
    {
        return self::$SESSION_ID_KEY;
    }

    public static function getRoute()
    {
        return self::$URI;
    }
}