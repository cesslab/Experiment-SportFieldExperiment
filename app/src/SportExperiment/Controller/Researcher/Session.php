<?php namespace SportExperiment\Controller\Researcher;

use SportExperiment\Repository\ResearcherRepositoryInterface;
use SportExperiment\View\Composer\Researcher\Session as SessionComposer;
use SportExperiment\Repository\ModelCollection;
use SportExperiment\Repository\Eloquent\Session as ExperimentSession;
use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;
use SportExperiment\Controller\BaseController;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Input;

class Session extends BaseController
{
    public static $URI = 'researcher/experiment/session';

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
        $modelCollection->addModel(new WillingnessPay(Input::all()));
        $modelCollection->addModel(new RiskAversion(Input::all()));

        if ($modelCollection->validationFails())
            return Redirect::to(self::$URI)->withInput()->with('errors', $modelCollection->getErrorMessages());

        $this->researcherRepository->saveSession($modelCollection);
        return Redirect::to(Dashboard::$URI);
    }

} 