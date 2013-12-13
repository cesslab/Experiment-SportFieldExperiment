<?php namespace SportExperiment\Controller\Subject\PreGame;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use SportExperiment\Controller\BaseController;
use SportExperiment\Model\Eloquent\PreGameQuestionnaire;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\SubjectState;
use SportExperiment\View\Composer\Subject\PreGame\Questionnaire as PreGameQuestionnaireComposer;
use SportExperiment\Controller\Subject\Experiment as ExperimentController;

class Questionnaire extends BaseController
{
    private static $URI = 'subject/pregame/questions';

    /**
     * @var \SportExperiment\Model\Eloquent\Subject $subject
     */
    private $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;

        View::composer(PreGameQuestionnaireComposer::$VIEW_PATH, PreGameQuestionnaireComposer::getNamespace());
    }

    public function getQuestionnaire()
    {
        return View::make(PreGameQuestionnaireComposer::$VIEW_PATH);
    }

    public function postQuestionnaire()
    {
        $preGameQuestionnaire = new PreGameQuestionnaire(Input::all());
        if ($preGameQuestionnaire->validationFails())
            return Redirect::to(self::getRoute())->withInput()->with('errors', $preGameQuestionnaire->getErrorMessages());

        $preGameQuestionnaire->subject()->associate($this->subject);
        $preGameQuestionnaire->save();

        $this->subject->setState(SubjectState::$PRE_GAME_HOLD_STATE);
        $this->subject->save();
        return Redirect::to(ExperimentController::getRoute());
    }

    public static function getRoute()
    {
        return self::$URI;
    }

} 