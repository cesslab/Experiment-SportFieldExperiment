<?php namespace SportExperiment\Controller\Subject;

use SportExperiment\Model\Eloquent\User;
use SportExperiment\Controller\BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use SportExperiment\Model\Eloquent\Role;

class Login extends BaseController
{
    public static $URI = 'subject/login';

    public function getLogin()
    {
        Auth::logout();
        return View::make('site.subject.login');
    }

    public function postLogin()
    {
        $user = new User(Input::all());

        // Validate raw user attributes
        if ($user->validationFails())
            return Redirect::to(self::getRoute())->withErrors($user->getValidator());

        // Confirm researcher account exists and is active
        if ( ! $user->isRole(new Role(Role::$SUBJECT)))
            return Redirect::to(self::getRoute())->with('error', 'Account not found');

        // Attempt login using Auth
        if ( ! Auth::attempt($user->getAuthInfo()))
            return Redirect::to(self::getRoute())->with('error', 'Unable to authorize');

        return Redirect::to(Registration::getRoute());
    }

    public static function getRoute()
    {
        return self::$URI;
    }

}
