<?php namespace SportExperiment\View\Composer\Subject;


use Illuminate\Support\Facades\URL;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Subject\Questionnaire as QuestionnaireController;

class Questionnaire extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.experiment.questionnaire';
    private $subject;


    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function compose($view)
    {
        $view->with('postUrl', URL::to(QuestionnaireController::getRoute()));
    }

} 