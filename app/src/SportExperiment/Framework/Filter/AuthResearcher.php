<?php namespace SportExperiment\Framework\Filter;

use SportExperiment\Domain\Model\Role;

class AuthResearcher  
{
    public function filter()
    {
        if( ! \Auth::check())
            return \Redirect::to('researcher/login');

        if (\Auth::user()->role != Role::$RESEARCHER) {
            \Auth::logout();
            return \Redirect::to('researcher/login');
        }
    }

}
