<?php namespace SportExperiment\View\Composer\Researcher;


use SportExperiment\Model\Eloquent\SubjectState;
use SportExperiment\Model\ResearcherRepositoryInterface;
use SportExperiment\View\Composer\BaseComposer;

class SessionTable extends BaseComposer
{
    public static $VIEW_PATH = 'site.researcher.session.table';

    public $researcherRepository;

    public function __construct(ResearcherRepositoryInterface $researcherRepository)
    {
        $this->researcherRepository = $researcherRepository;
    }

    public function compose($view)
    {
        $view->with('subjects', $this->researcherRepository->getSubjects());
        $view->with('registrationState', SubjectState::$REGISTRATION);
        $view->with('holdState', SubjectState::$PRE_GAME_HOLD_STATE);
        $view->with('gameState', SubjectState::$GAME_PLAY);
        $view->with('payoffState', SubjectState::$PAYOFF);
        $view->with('questionnaireState', SubjectState::$OUTGOING_QUESTIONNAIRE);
        $view->with('completedState', SubjectState::$COMPLETED);
        $view->with('preGameQuestionnaireState', SubjectState::$PRE_GAME_QUESTIONNAIRE_STATE);
    }
}