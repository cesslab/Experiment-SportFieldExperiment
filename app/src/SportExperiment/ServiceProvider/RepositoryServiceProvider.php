<?php namespace SportExperiment\ServiceProvider;

use SportExperiment\Repository\ResearcherRepository;
use Illuminate\Support\ServiceProvider;
use SportExperiment\Repository\SubjectRepository;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('SportExperiment\\Repository\\ResearcherRepositoryInterface', function()
        {
            return new ResearcherRepository;
        });
        $this->app->bind('SportExperiment\\Repository\\SubjectRepositoryInterface', function()
        {
            return new SubjectRepository;
        });
    }

}