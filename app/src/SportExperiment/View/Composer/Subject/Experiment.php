<?php namespace SportExperiment\View\Composer\Subject;

use Illuminate\Support\Facades\Auth;
use SportExperiment\Model\Eloquent\RiskAversionEntry;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\UltimatumEntry;
use SportExperiment\Model\Eloquent\UltimatumRole;
use SportExperiment\Model\Eloquent\UltimatumTreatment;
use SportExperiment\Model\Eloquent\WillingnessPayEntry;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Subject\Experiment as ExperimentController;
use Illuminate\Support\Facades\URL;

class Experiment extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.experiment';
    private $subject;
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function compose($view)
    {
        $willingnessPayTreatment = $this->subject->getWillingnessPayTreatment();
        $view->with('displayWillingnessPay', $willingnessPayTreatment != null);
        if ($willingnessPayTreatment != null) {
            $view->with('endowment', $willingnessPayTreatment->getEndowment());
            $view->with('willingnessPayTaskId', WillingnessPayTreatment::getTaskId());
            $view->with('willingPayKey', WillingnessPayEntry::$WILLING_PAY_KEY);
        }


        $riskAversionTreatment = $this->subject->getRiskAversionTreatment();
        $view->with('displayRiskAversion', $riskAversionTreatment != null);
        if ($riskAversionTreatment != null) {
            $view->with('riskAversionTaskId', RiskAversionTreatment::getTaskId());
            $view->with('lowPrize', $riskAversionTreatment->getLowPrize());
            $view->with('midPrize', $riskAversionTreatment->getMidPrize());
            $view->with('highPrize', $riskAversionTreatment->getHighPrize());
            $view->with('gambleProb', $riskAversionTreatment->getGambleProbability());
            $view->with('indifferenceProbabilityKey', RiskAversionEntry::$INDIFFERENCE_PROBABILITY_KEY);
        }

        $ultimatumTreatment = $this->subject->getUltimatumTreatment();
        $view->with('displayUltimatum', $ultimatumTreatment != null);
        if ($ultimatumTreatment != null) {
            $view->with('ultimatumTaskId', UltimatumTreatment::getTaskId());
            $view->with('ultimatumTotalAmount', $ultimatumTreatment->getTotalAmount());
            $view->with('isProposer', $this->subject->getUltimatumRole()->getRole() == UltimatumRole::getProposerId());
            $view->with('amountKey', UltimatumEntry::$AMOUNT_KEY);
        }

        $view->with('postUrl', URL::to(ExperimentController::getRoute()));
    }
}