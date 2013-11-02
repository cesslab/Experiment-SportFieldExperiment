<?php namespace SportExperiment\Framework\Controller\Researcher;

use SportExperiment\Domain\Repository\ResearcherRepositoryInterface;
use SportExperiment\Framework\Controller\BaseController;
use SportExperiment\Framework\View\Composer\Researcher\Dashboard as DashboardComposer;

class Dashboard extends BaseController
{
    private $researcherRepository;

    public function __construct(ResearcherRepositoryInterface $researcherRepository)
    {
        $this->researcherRepository = $researcherRepository;
        \View::composer(DashboardComposer::$VIEW_PATH, DashboardComposer::getNamespace());
    }

    public function getDashboard() 
    {
        return \View::make(DashboardComposer::$VIEW_PATH);
    }

}