<?php namespace SportExperiment\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use SportExperiment\Model\Eloquent\Subject;

class SubjectProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Subject::getNamespace(), function()
        {
            return Auth::user()->subject;
        });
    }
}