<?php namespace SportExperiment\View\Composer\Subject;


use SportExperiment\View\Composer\BaseComposer;
use Illuminate\Support\Facades\URL;
use SportExperiment\Controller\Subject\Registration as RegistrationController;
use SportExperiment\Model\Eloquent\Subject;

class Registration extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.registration';

    public function compose($view)
    {
        $view->with('postUrl', URL::to(RegistrationController::getRoute()));
        $view->with('firstName', Subject::$FIRST_NAME_KEY);
        $view->with('lastName', Subject::$LAST_NAME_KEY);
        $view->with('profession', Subject::$PROFESSION_KEY);
        $view->with('education', Subject::$EDUCATION_KEY);
        $view->with('gender', Subject::$GENDER_KEY);
        $view->with('ethnicity', Subject::$ETHNICITY_KEY);
        $view->with('age', Subject::$AGE_KEY);
    }
}
