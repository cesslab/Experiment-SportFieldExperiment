<?php namespace SportExperiment\View\Composer\Researcher;

use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Repository\ResearcherRepositoryInterface;

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
    }

    public static function getNamespace()
    {
        return get_called_class();
    }
}