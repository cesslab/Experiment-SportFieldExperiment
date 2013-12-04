<?php namespace SportExperiment\Controller\Researcher;

use Illuminate\Support\Facades\Lang;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Input;

use SportExperiment\Model\Eloquent\TrustTreatment;
use SportExperiment\Model\Eloquent\UltimatumTreatment;
use SportExperiment\Model\ResearcherRepositoryInterface;
use SportExperiment\View\Composer\Researcher\Session as SessionComposer;
use SportExperiment\Model\ModelCollection;
use SportExperiment\Model\Eloquent\Session as ExperimentSession;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use SportExperiment\Controller\BaseController;
use SportExperiment\Model\Eloquent\DictatorTreatment;

class Session extends BaseController
{
    private static $URI = 'researcher/experiment/session';
    private static $UPDATE_URI = 'researcher/experiment/session/update';

    private $researcherRepository;

    public function __construct(ResearcherRepositoryInterface $researcherRepository)
    {
        $this->researcherRepository = $researcherRepository;
        View::composer(SessionComposer::$VIEW_PATH, SessionComposer::getNamespace());
    }

    public function getSession()
    {
        return View::make(SessionComposer::$VIEW_PATH);
    }

    public function postSession()
    {
        $modelCollection = new ModelCollection();
        $modelCollection->addModel(new ExperimentSession(Input::all()));

        $totalTasks = 0;
        if (Input::get(WillingnessPayTreatment::$TREATMENT_ENABLED_KEY) !== null) {
            $modelCollection->addModel(new WillingnessPayTreatment(Input::all()));
            ++$totalTasks;
        }
        if (Input::get(RiskAversionTreatment::$TREATMENT_ENABLED_KEY) !== null) {
            $modelCollection->addModel(new RiskAversionTreatment(Input::all()));
            ++$totalTasks;
        }
        if (Input::get(UltimatumTreatment::$TREATMENT_ENABLED_KEY) !== null) {
            $modelCollection->addModel(new UltimatumTreatment(Input::all()));
            ++$totalTasks;
        }
        if (Input::get(TrustTreatment::$TREATMENT_ENABLED_KEY) !== null) {
            $modelCollection->addModel(new TrustTreatment(Input::all()));
            ++$totalTasks;
        }
        if (Input::get(DictatorTreatment::$TREATMENT_ENABLED_KEY) !== null) {
            $modelCollection->addModel(new DictatorTreatment(Input::all()));
            ++$totalTasks;
        }

        if ($totalTasks < ExperimentSession::$TASK_MINIMUM) {
            return Redirect::to(self::getRoute())->with('error', Lang::get('errors.min_tasks_required'));
        }

        if ($modelCollection->validationFails()) {
            return Redirect::to(self::getRoute())->withInput()->with('errors', $modelCollection->getErrorMessages());
        }

        $this->researcherRepository->saveSession($modelCollection);
        return Redirect::to(Dashboard::getRoute());
    }

    public function updateSession()
    {
        $postedSession = new ExperimentSession();
        $postedSession->clearValidationRules();
        $postedSession->setIdValidationRule();
        $postedSession->setStateValidationRule();
        $postedSession->setId(Input::get(ExperimentSession::$ID_KEY));
        $postedSession->setState(Input::get(ExperimentSession::$STATE_KEY));

        // Validate Session ID and State
        if ($postedSession->validationFails()){
            return Redirect::to(Dashboard::getRoute())->withInput()->with('errors', $postedSession->getErrorMessages());
        }

        $session = $this->researcherRepository->getSession($postedSession->getId());

        // Start Experiment
        if ($postedSession->isStarted() && $session->isStopped()) {
            if ( ! $session->isStartable()) {
                return Redirect::to(Dashboard::getRoute())->with('error', Lang::get('errors.registration_required'));
            }

            // Save Session State
            $session->setState($postedSession->getState());
            $session->save();
        }
        // Stop Experiment
        elseif ($postedSession->isStopped() && $session->isStarted()) {
            if ( ! $session->isStoppable()) {
                return Redirect::to(Dashboard::getRoute())->with('error', Lang::get('errors.subject_entry_required'));
            }

            // Calculate Subject Payoffs
            $session->calculatePayoffs();

            // Save Session State
            $session->setState($postedSession->getState());
            $session->save();
        }

        return Redirect::to(Dashboard::getRoute());
    }

    public static function getRoute()
    {
        return self::$URI;
    }

    public static function getUpdateRoute()
    {
        return self::$UPDATE_URI;
    }

} 