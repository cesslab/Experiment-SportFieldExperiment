<?php namespace SportExperiment\View\Composer\Subject;

use SportExperiment\Model\Eloquent\DictatorTreatment;
use SportExperiment\Model\Eloquent\RiskAversionEntry;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\TrustProposerEntry;
use SportExperiment\Model\Eloquent\TrustTreatment;
use SportExperiment\Model\Eloquent\UltimatumEntry;
use SportExperiment\Model\Eloquent\UltimatumTreatment;
use SportExperiment\Model\Eloquent\WillingnessPayEntry;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Subject\Experiment as ExperimentController;
use Illuminate\Support\Facades\URL;
use SportExperiment\Model\Eloquent\DictatorEntry;

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
            $view->with('isUltimatumProposer', $this->subject->getUltimatumGroup()->getSubjectRole() == UltimatumTreatment::getProposerRoleId());
            $view->with('amountKey', UltimatumEntry::$AMOUNT_KEY);
        }

        $trustTreatment = $this->subject->getTrustTreatment();
        $view->with('displayTrust', $trustTreatment != null);
        if ($trustTreatment != null) {
            $proposerAllocations = $this->composeProposerAllocations(
                array_merge(['dev'=>'--'], $trustTreatment->getProposerAllocationOptions()));
            $view->with('trustTaskId', TrustTreatment::getTaskId());
            $view->with('isTrustProposer', $this->subject->getTrustGroup()->getSubjectRole() == TrustTreatment::getProposerRoleId());
            $view->with('proposerAllocationOptions', $proposerAllocations);
            $view->with('receiverAllocationOptions', $trustTreatment->getReceiverAllocationOptions());
            $view->with('numProposerAllocations', TrustTreatment::getNumProposerAllocations());
            $view->with('numReceiverAllocations', TrustTreatment::getNumReceiverAllocations());
            $view->with('allocationKey', TrustProposerEntry::$ALLOCATION_KEY);
        }

        $dictatorTreatment = $this->subject->getDictatorTreatment();
        $view->with('displayDictator', $dictatorTreatment != null);
        if ($dictatorTreatment != null) {
            $view->with('dictatorTaskId', DictatorTreatment::getTaskId());
            $view->with('dictatorEndowment', $dictatorTreatment->getProposerEndowment());
            $view->with('dictatorAllocationKey', DictatorEntry::$DICTATOR_ALLOCATION_KEY);
        }

        $view->with('postUrl', URL::to(ExperimentController::getRoute()));
    }

    private function composeProposerAllocations($allocations)
    {
        $proposerAllocations = [];
        foreach ($allocations as $allocation) {
            $proposerAllocations[$allocation] = $allocation;
        }
        return $proposerAllocations;
    }
}