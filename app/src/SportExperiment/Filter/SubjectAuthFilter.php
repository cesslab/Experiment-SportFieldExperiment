<?php namespace SportExperiment\Filter;

use SportExperiment\Model\Eloquent\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SportExperiment\Controller\Subject\Login;

class SubjectAuthFilter  extends BaseFilter
{
    public static $FILTER_NAME = 'authSubject';

    public function filter()
    {
        if( ! Auth::check())
            return Redirect::to(Login::getRoute());

        if (Auth::user()->role != UserRole::$SUBJECT || Auth::user()->subject == null) {
            Auth::logout();
            return Redirect::to(Login::getRoute());
        }
    }

    public static function getName()
    {
        return self::$FILTER_NAME;
    }

}
