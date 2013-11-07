<?php namespace SportExperiment\Filter;

use SportExperiment\Repository\Eloquent\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use SportExperiment\Controller\Subject\Login;
use SportExperiment\Router\SubjectRouter;

class AuthorizeSubject  extends BaseFilter
{
    public static $FILTER_NAME = 'authSubject';

    public function filter()
    {
        if( ! Auth::check())
            return Redirect::to(Login::$URI);

        if (Auth::user()->role != Role::$SUBJECT || Auth::user()->subject == null) {
            Auth::logout();
            return Redirect::to(Login::$URI);
        }

        $subject = Auth::user()->subject;
        $subjectRouter = new SubjectRouter();
        if ( ! $subjectRouter->isValidRoute($subject, Route::getCurrentRoute()->getPath())) {
            return Redirect::to($subjectRouter->getRoute($subject));
        }
    }

    public static function getName()
    {
        return self::$FILTER_NAME;
    }

}
