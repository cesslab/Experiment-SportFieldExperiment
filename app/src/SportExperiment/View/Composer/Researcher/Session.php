<?php namespace SportExperiment\View\Composer\Researcher;

use SportExperiment\Model\Eloquent\TrustTreatment;
use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Researcher\Dashboard as DashboardController;
use SportExperiment\Model\Eloquent\Session as SessionModel;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use SportExperiment\Controller\Researcher\Session as SessionController;
use Illuminate\Support\Facades\URL;
use SportExperiment\Model\Eloquent\UltimatumTreatment;
use SportExperiment\Model\Eloquent\DictatorTreatment;

class Session extends BaseComposer
{
    public static $VIEW_PATH = 'site.researcher.session.add';

    public function compose($view)
    {
        $view->with('dashboardUrl', URL::to(DashboardController::getRoute()));
        $view->with('postUrl', URL::to(SessionController::getRoute()));
        $view->with('numSubjectsKey', SessionModel::$NUM_SUBJECTS_KEY);
        $view->with('willingnessPayTaskId', WillingnessPayTreatment::getTaskId());
        $view->with('endowmentKey', WillingnessPayTreatment::$ENDOWMENT_KEY);
        $view->with('riskAversionTaskId', RiskAversionTreatment::getTaskId());
        $view->with('lowPrizeKey', RiskAversionTreatment::$LOW_PRIZE_KEY);
        $view->with('midPrizeKey', RiskAversionTreatment::$MID_PRIZE_KEY);
        $view->with('highPrizeKey', RiskAversionTreatment::$HIGH_PRIZE_KEY);
        $view->with('gambleProbKey', RiskAversionTreatment::$GAMBLE_PROBABILITY_KEY);
        $view->with('ultimatumTaskId', UltimatumTreatment::getTaskId());
        $view->with('ultimatumTotalAmountKey', UltimatumTreatment::$TOTAL_AMOUNT_KEY);
        $view->with('trustTaskId', TrustTreatment::getTaskId());
        $view->with('trustSenderMultiplierKey', TrustTreatment::$PROPOSER_ALLOCATION_MULTIPLIER_KEY);
        $view->with('trustReceiverMultiplierKey', TrustTreatment::$RECEIVER_ALLOCATION_MULTIPLIER_KEY);
        $view->with('dictatorTaskId', DictatorTreatment::getTaskId());
        $view->with('dictatorEndowmentKey', DictatorTreatment::$PROPOSER_ENDOWMENT_KEY);
    }
}