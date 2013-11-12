<?php namespace SportExperiment\ServiceProvider;

use SportExperiment\Model\ResearcherRepository;
use Illuminate\Support\ServiceProvider;
use SportExperiment\Model\SubjectRepository;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('SportExperiment\\Model\\ResearcherRepositoryInterface', function()
        {
            return new ResearcherRepository;
        });
        $this->app->bind('SportExperiment\\Model\\SubjectRepositoryInterface', function()
        {
            return new SubjectRepository;
        });
    }

}