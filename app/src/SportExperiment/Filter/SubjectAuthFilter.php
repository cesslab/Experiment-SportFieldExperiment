<?php namespace SportExperiment\Filter;

use SportExperiment\Repository\Eloquent\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use SportExperiment\Controller\Subject\Login;
use SportExperiment\Router\SubjectRouter;

class SubjectAuthFilter  extends BaseFilter
{
    public static $FILTER_NAME = 'authSubject';

    public function filter()
    {
        if( ! Auth::check())
            return Redirect::to(Login::getRoute());

        if (Auth::user()->role != Role::$SUBJECT || Auth::user()->subject == null) {
            Auth::logout();
            return Redirect::to(Login::getRoute());
        }
    }

    public static function getName()
    {
        return self::$FILTER_NAME;
    }

}
