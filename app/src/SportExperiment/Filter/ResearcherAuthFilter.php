<?php namespace SportExperiment\Filter;

use SportExperiment\Model\Eloquent\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ResearcherAuthFilter  extends BaseFilter
{
    public static $FILTER_NAME = 'authResearcher';

    public function filter()
    {
        if( ! Auth::check())
            return Redirect::to('researcher/login');

        if (Auth::user()->role != Role::$RESEARCHER) {
            Auth::logout();
            return Redirect::to('researcher/login');
        }
    }

    public static function getName()
    {
        return self::$FILTER_NAME;
    }

}
