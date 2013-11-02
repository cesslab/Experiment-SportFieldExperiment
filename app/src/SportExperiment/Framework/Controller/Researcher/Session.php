<?php namespace SportExperiment\Framework\Controller\Researcher;

use SportExperiment\Domain\Model\ModelCollection;
use SportExperiment\Framework\Controller\BaseController;
use SportExperiment\Domain\Model\Experiment\Session as ExperimentSession;
use SportExperiment\Framework\View\Composer\Researcher\Dashboard as DashboardComposer;
use SportExperiment\Domain\Model\Experiment\Treatment\RiskAversion;
use SportExperiment\Domain\Model\Experiment\Treatment\WillingnessPay;
use SportExperiment\Domain\Repository\ResearcherRepositoryInterface;

class Session extends BaseController
{
    private $researcherRepository;

    public function __construct(ResearcherRepositoryInterface $researcherRepository)
    {
        $this->researcherRepository = $researcherRepository;
        \View::composer(DashboardComposer::$VIEW_PATH, DashboardComposer::getNamespace());
    }

    public function postSession()
    {
        $modelCollection = new ModelCollection();
        $modelCollection->addModel(new ExperimentSession(\Input::all()));
        $modelCollection->addModel(new WillingnessPay(\Input::all()));
        $modelCollection->addModel(new RiskAversion(\Input::all()));

        if ($modelCollection->validationFails())
            return \Redirect::to('researcher/dashboard')->with('errors', $modelCollection->getErrorMessages());

        $this->researcherRepository->saveSession($modelCollection);
        return \Redirect::to('researcher/dashboard');
    }

} 