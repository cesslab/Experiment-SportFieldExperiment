<?php namespace SportExperiment\View\Composer\Subject;

use Illuminate\Support\Facades\Auth;

class Experiment
{
    public function compose($view)
    {
        $subject = Auth::user()->subject;
        /* @var $willingnessPay \SportExperiment\Repository\Eloquent\Treatment\WillingnessPay */
        $willingnessPay = $subject->session->willingnessPay;
        $view->with('endowment', $willingnessPay->getEndowment());

        /* @var $riskAversion \SportExperiment\Repository\Eloquent\Treatment\RiskAversion */
        $riskAversion = $subject->session->riskAversion;
        $view->with('lowPrize', $riskAversion->getLowPrize());
        $view->with('midPrize', $riskAversion->getMidPrize());
        $view->with('highPrize', $riskAversion->getHighPrize());
        $view->with('gambleProb', $riskAversion->getGambleProbability());
    }

} 