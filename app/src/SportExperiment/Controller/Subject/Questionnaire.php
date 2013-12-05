<?php namespace SportExperiment\Controller\Subject;

use Illuminate\Support\Facades\Redirect;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\SubjectState;
use SportExperiment\View\Composer\Subject\Questionnaire as QuestionnaireComposer;
use Illuminate\Support\Facades\View;
use SportExperiment\Controller\BaseController;

class Questionnaire extends BaseController
{
    public static $URI = 'subject/experiment/questionnaire';

    private $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
        View::composer(QuestionnaireComposer::$VIEW_PATH, QuestionnaireComposer::getNamespace());
    }

    public function getQuestionnaire()
    {
        return View::make(QuestionnaireComposer::$VIEW_PATH);
    }

    public function postQuestionnaire()
    {
        // TODO: Add questionnaire processing
        if ($this->subject->getState() == SubjectState::$OUTGOING_QUESTIONNAIRE) {
            $this->subject->setState(SubjectState::$COMPLETED);
            $this->subject->save();
        }

        return Redirect::to(Completed::getRoute());
    }

    public static function getRoute()
    {
        return self::$URI;
    }
}