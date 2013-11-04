<?php namespace SportExperiment\ServiceProvider;

use SportExperiment\Repository\ResearcherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('SportExperiment\\Repository\\ResearcherRepositoryInterface', function()
        {
            return new ResearcherRepository;
        });
    }

}