<?php namespace SportExperiment\View\Composer\Researcher;

use SportExperiment\Model\Eloquent\UltimatumGroup;
use SportExperiment\Model\Eloquent\SubjectState;
use SportExperiment\Model\Eloquent\UltimatumTreatment;
use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Researcher\Session as SessionController;
use SportExperiment\Model\ResearcherRepositoryInterface;
use Illuminate\Support\Facades\URL;
use SportExperiment\Model\Eloquent\SessionState;
use SportExperiment\Model\Eloquent\Session;

class Dashboard extends BaseComposer
{
    public $researcherRepository;
    public static $VIEW_PATH = 'site.researcher.dashboard';

    public function __construct(ResearcherRepositoryInterface $researcherRepository)
    {
        $this->researcherRepository = $researcherRepository;
    }

    public function compose($view)
    {
        $view->with('sessions', $this->researcherRepository->getSessions());
        $view->with('sessionIdKey', Session::$ID_KEY);
        $view->with('subjects', $this->researcherRepository->getSubjects());
        $view->with('sessionStartState', SessionState::$STARTED);
        $view->with('sessionStopState', SessionState::$STOPPED);
        $view->with('sessionStateKey', Session::$STATE_KEY);
        $view->with('sessionUrl', URL::to(SessionController::getRoute()));
        $view->with('registrationState', SubjectState::$REGISTRATION);
        $view->with('holdState', SubjectState::$PRE_GAME_HOLD_STATE);
        $view->with('gameState', SubjectState::$GAME_PLAY);
        $view->with('payoffState', SubjectState::$PAYOFF);
        $view->with('questionnaireState', SubjectState::$OUTGOING_QUESTIONNAIRE);
        $view->with('completedState', SubjectState::$COMPLETED);
        $view->with('postUrl', URL::to(SessionController::getUpdateRoute()));
        $view->with('ultimatumProposerRoleId', UltimatumTreatment::getProposerRoleId());
        $view->with('ultimatumReceiverRoleId', UltimatumTreatment::getReceiverRoleId());
    }
}