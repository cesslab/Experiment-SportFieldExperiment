<?php namespace SportExperiment\Filter;

use SportExperiment\Repository\Eloquent\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthorizeSubject  extends BaseFilter
{
    public static $FILTER_NAME = 'authSubject';

    public function filter()
    {
        if( ! Auth::check())
            return Redirect::to('subject/login');

        if (Auth::user()->role != Role::$SUBJECT) {
            Auth::logout();
            return Redirect::to('subject/login');
        }
    }

    public static function getName()
    {
        return self::$FILTER_NAME;
    }

}
