<?php namespace SportExperiment\View\Composer\Researcher;

use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Researcher\Dashboard as DashboardController;
use SportExperiment\Repository\Eloquent\Session as SessionModel;
use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;
use SportExperiment\Controller\Researcher\Session as SessionController;
use Illuminate\Support\Facades\URL;

class Session extends BaseComposer
{
    public static $VIEW_PATH = 'site.researcher.session.add';

    public function compose($view)
    {
        $view->with('dashboardUrl', URL::to(DashboardController::$URI));
        $view->with('postUrl', URL::to(SessionController::$URI));
        $view->with('numSubjectsKey', SessionModel::$NUM_SUBJECTS_KEY);
        $view->with('endowmentKey', WillingnessPay::$ENDOWMENT_KEY);
        $view->with('lowPrizeKey', RiskAversion::$LOW_PRIZE_KEY);
        $view->with('midPrizeKey', RiskAversion::$MID_PRIZE_KEY);
        $view->with('highPrizeKey', RiskAversion::$HIGH_PRIZE_KEY);
        $view->with('gambleProbKey', RiskAversion::$GAMBLE_PROBABILITY_KEY);
    }

} 