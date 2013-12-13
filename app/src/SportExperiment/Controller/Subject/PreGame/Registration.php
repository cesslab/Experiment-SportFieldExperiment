<?php namespace SportExperiment\Controller\Subject\PreGame;

use SportExperiment\Controller\BaseController;
use SportExperiment\Model\Eloquent\SubjectState;
use SportExperiment\Model\SubjectRepositoryInterface;
use SportExperiment\View\Composer\Subject\PreGame\Registration as RegistrationComposer;
use \Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SportExperiment\Controller\Subject\PreGame\Questionnaire as QuestionnaireController;

class Registration extends BaseController
{
    private static $URI = 'subject/registration';

    private $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
        View::composer(RegistrationComposer::$VIEW_PATH, RegistrationComposer::getNamespace());
    }

    public function getRegistration()
    {
        return View::make(RegistrationComposer::$VIEW_PATH);
    }

    public function postRegistration()
    {
        $subject = Auth::user()->subject;
        $subject->fill(Input::all());
        if ($subject->validationFails())
            return Redirect::to(self::getRoute())->withInput()->with('errors', $subject->getErrorMessages());

        $subject->setState(SubjectState::$PRE_GAME_QUESTIONNAIRE_STATE);
        $subject->save();

        return Redirect::to(QuestionnaireController::getRoute());
    }

    public static function getRoute()
    {
        return self::$URI;
    }
}
