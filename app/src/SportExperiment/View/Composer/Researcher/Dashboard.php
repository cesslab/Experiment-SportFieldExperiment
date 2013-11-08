<?php namespace SportExperiment\View\Composer\Researcher;

use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Researcher\Session as SessionController;
use SportExperiment\Repository\ResearcherRepositoryInterface;
use Illuminate\Support\Facades\URL;
use SportExperiment\Repository\Eloquent\SessionState;
use SportExperiment\Repository\Eloquent\Session;

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
        $view->with('subjects', $this->researcherRepository->getSubjects());
        $view->with('sessionStartState', SessionState::$STARTED);
        $view->with('sessionStopState', SessionState::$STOPPED);
        $view->with('sessionStateKey', Session::$STATE_KEY);
        $view->with('sessionUrl', URL::to(SessionController::getRoute()));
        $view->with('updateSessionUrl', URL::to(SessionController::getUpdateRoute()));
    }
}