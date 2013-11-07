<?php namespace SportExperiment\View\Composer\Subject;

use Illuminate\Support\Facades\Auth;
use SportExperiment\Controller\BaseController;
use SportExperiment\Controller\Subject\Experiment as ExperimentController;
use Illuminate\Support\Facades\URL;

class Experiment extends BaseController
{
    public static $VIEW_PATH = 'site.subject.experiment';

    public function compose($view)
    {
        $subject = Auth::user()->subject;

        /* @var $willingnessPay \SportExperiment\Repository\Eloquent\Treatment\WillingnessPay */
        $willingnessPay = $subject->session->willingnessPay;
        $view->with('displayWillingnessPay', $willingnessPay != null);
        if ($willingnessPay != null)
            $view->with('endowment', $willingnessPay->getEndowment());


        /* @var $riskAversion \SportExperiment\Repository\Eloquent\Treatment\RiskAversion */
        $riskAversion = $subject->session->riskAversion;
        $view->with('displayRiskAversion', $riskAversion != null);
        if ($riskAversion != null) {
            $view->with('lowPrize', $riskAversion->getLowPrize());
            $view->with('midPrize', $riskAversion->getMidPrize());
            $view->with('highPrize', $riskAversion->getHighPrize());
            $view->with('gambleProb', $riskAversion->getGambleProbability());
        }

        $view->with('postUrl', URL::to(ExperimentController::$URI));
    }
}