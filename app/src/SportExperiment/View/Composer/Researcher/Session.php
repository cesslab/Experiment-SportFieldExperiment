<?php namespace SportExperiment\View\Composer\Researcher;

use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Researcher\Dashboard as DashboardController;
use SportExperiment\Repository\Eloquent\Session as SessionModel;
use SportExperiment\Repository\Eloquent\WillingnessPayTreatment;
use SportExperiment\Repository\Eloquent\RiskAversionTreatment;
use SportExperiment\Controller\Researcher\Session as SessionController;
use Illuminate\Support\Facades\URL;

class Session extends BaseComposer
{
    public static $VIEW_PATH = 'site.researcher.session.add';

    public function compose($view)
    {
        $view->with('dashboardUrl', URL::to(DashboardController::getRoute()));
        $view->with('postUrl', URL::to(SessionController::getRoute()));
        $view->with('numSubjectsKey', SessionModel::$NUM_SUBJECTS_KEY);
        $view->with('endowmentKey', WillingnessPayTreatment::$ENDOWMENT_KEY);
        $view->with('lowPrizeKey', RiskAversionTreatment::$LOW_PRIZE_KEY);
        $view->with('midPrizeKey', RiskAversionTreatment::$MID_PRIZE_KEY);
        $view->with('highPrizeKey', RiskAversionTreatment::$HIGH_PRIZE_KEY);
        $view->with('gambleProbKey', RiskAversionTreatment::$GAMBLE_PROBABILITY_KEY);
    }

} 