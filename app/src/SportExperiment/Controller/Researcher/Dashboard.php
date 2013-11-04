<?php namespace SportExperiment\Controller\Researcher;

use SportExperiment\Controller\BaseController;
use SportExperiment\Repository\ResearcherRepositoryInterface;
use SportExperiment\View\Composer\Researcher\Dashboard as DashboardComposer;
use \Illuminate\Support\Facades\View;

class Dashboard extends BaseController
{
    public static $URI = 'researcher/dashboard';

    private $researcherRepository;

    public function __construct(ResearcherRepositoryInterface $researcherRepository)
    {
        $this->researcherRepository = $researcherRepository;
        View::composer(DashboardComposer::$VIEW_PATH, DashboardComposer::getNamespace());
    }

    public function getDashboard() 
    {
        return View::make(DashboardComposer::$VIEW_PATH);
    }

}