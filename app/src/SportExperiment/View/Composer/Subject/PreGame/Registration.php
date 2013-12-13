<?php namespace SportExperiment\View\Composer\Subject\PreGame;


use SportExperiment\View\Composer\BaseComposer;
use Illuminate\Support\Facades\URL;
use SportExperiment\Controller\Subject\PreGame\Registration as RegistrationController;
use SportExperiment\Model\Eloquent\Subject;

class Registration extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.registration';

    public function compose($view)
    {
        $view->with('postUrl', URL::to(RegistrationController::getRoute()));
        $view->with('firstName', Subject::$FIRST_NAME_KEY);
        $view->with('lastName', Subject::$LAST_NAME_KEY);

        $view->with('education', Subject::$EDUCATION_KEY);
        $view->with('educationOptions', array_merge(['default'=>'Select Highest Degree Achieved'], Subject::getEducationOptions()));

        $view->with('gender', Subject::$GENDER_KEY);
        $view->with('genderOptions', ['default'=>'Select Your Gender', 'male'=>'Male', 'female'=>'Female']);

        $view->with('workStatus', Subject::$WORK_STATUS_KEY);
        $view->with('workStatusOptions', array_merge(['default'=>'Select Your Current Work Status'], Subject::getWorkStatusOptions()));

        $view->with('income', Subject::$INCOME_KEY);
        $view->with('incomeOptions', array_merge(['default'=>'Select Your Income Range'], Subject::getIncomeOptions()));

        $view->with('age', Subject::$AGE_KEY);
        $ageRange = array_combine(range(18, 100), range(18,100));
        $ageRange['default'] = 'Select Your Age';
        $view->with('ageOptions', $ageRange);
    }
}
