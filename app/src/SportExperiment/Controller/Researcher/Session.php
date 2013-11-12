<?php namespace SportExperiment\Controller\Researcher;

use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Input;

use SportExperiment\Model\Eloquent\SessionState;
use SportExperiment\Model\ResearcherRepositoryInterface;
use SportExperiment\View\Composer\Researcher\Session as SessionComposer;
use SportExperiment\Model\ModelCollection;
use SportExperiment\Model\Eloquent\Session as ExperimentSession;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use SportExperiment\Controller\BaseController;
use SportExperiment\Model\Eloquent\Session as SessionModel;
use SportExperiment\Validation\IdValidator;

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
        $modelCollection->addModel(new WillingnessPayTreatment(Input::all()));
        $modelCollection->addModel(new RiskAversionTreatment(Input::all()));

        if ($modelCollection->validationFails())
            return Redirect::to(self::getRoute())->withInput()->with('errors', $modelCollection->getErrorMessages());

        $this->researcherRepository->saveSession($modelCollection);
        return Redirect::to(Dashboard::getRoute());
    }

    public function updateSession()
    {
        $idValidator = new IdValidator();

        // Validate ID
        $idValidator->setId(Input::get(SessionModel::$ID_KEY));
        if ($idValidator->validationFails()){
            return Redirect::to(Dashboard::getRoute())->withInput()->with('errors', $idValidator->getErrorMessages());
        }

        $session = SessionModel::find($idValidator->getId());
        if (is_null($session))
            return Redirect::to(Dashboard::getRoute())->withInput()->with('error', 'Session not found.');

        $sessionState = new SessionState();
        $sessionState->setState(Input::get(SessionModel::$STATE_KEY));

        // Validate Session State
        if ($sessionState->validationFails())
            return Redirect::to(Dashboard::getRoute())->withInput()->with('errors', $sessionState->getErrorMessages());

        $session->setState($sessionState->getState());
        $session->save();
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