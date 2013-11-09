<?php namespace SportExperiment\View\Composer\Subject;


use SportExperiment\View\Composer\BaseComposer;
use Illuminate\Support\Facades\URL;
use SportExperiment\Controller\Subject\Registration as RegistrationController;

class Registration extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.registration';

    public function compose($view)
    {
        $view->with('postUrl', URL::to(RegistrationController::getRoute()));
    }
}
