<?php namespace SportExperiment\Framework\ServiceProvider;

use SportExperiment\Framework\Repository\ResearcherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('SportExperiment\\Domain\\Repository\\ResearcherRepositoryInterface', function()
        {
            return new ResearcherRepository;
        });
    }

}