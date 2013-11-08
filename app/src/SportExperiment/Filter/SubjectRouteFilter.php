<?php namespace SportExperiment\Filter;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SportExperiment\Router\SubjectRouter;

class SubjectRouteFilter extends BaseFilter
{
    public static $FILTER_NAME = 'subjectRoute';

    public function filter()
    {
        $subject = Auth::user()->subject;
        $router = new SubjectRouter();
        if ( ! $router->isCurrentRouteValid($subject))
            return Redirect::to($router->getRoute($subject));
    }

    public static function getName()
    {
        return self::$FILTER_NAME;
    }

} 