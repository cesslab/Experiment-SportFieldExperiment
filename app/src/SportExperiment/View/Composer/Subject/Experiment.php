<?php namespace SportExperiment\View\Composer\Subject;

use SportExperiment\Model\Eloquent\Charity;
use SportExperiment\Model\Eloquent\DictatorTreatment;
use SportExperiment\Model\Eloquent\Good;
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
use SportExperiment\Model\Eloquent\GameQuestionnaire as GameQuestionnaireModel;

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
        $entryState = $this->subject->getSubjectEntryState();

        // Display Tasks
        if ( ! $entryState->taskEntriesComplete()) {
            $view->with('displayTask', true);

            $nextTreatment = $this->subject->getSession()->getTask($entryState->getOrderId());

            // Willingness Pay
            $willingnessPayTreatment = $this->subject->getWillingnessPayTreatment();
            if ($willingnessPayTreatment instanceof $nextTreatment) {
                $chosenGood = $this->subject->getGood();
                if ($chosenGood == null) {
                    $view->with('getGood', true);
                    $view->with('good', Good::$GOOD_KEY);
                }
                else {
                    $view->with('getGood', false);
                    $view->with('good', $chosenGood->getGood());
                }

                $view->with('goodOptions', array_merge(['default'=>'Select A Good'], Good::getGoods()));
                $view->with('taskId', WillingnessPayTreatment::getTaskId());
                $view->with('endowment', $willingnessPayTreatment->getEndowment());
                $view->with('willingnessPayTaskId', WillingnessPayTreatment::getTaskId());
                $view->with('willingPayKey', WillingnessPayEntry::$WILLING_PAY_KEY);
            }
            $view->with('displayWillingnessPay', $willingnessPayTreatment instanceof $nextTreatment);

            // Risk Aversion
            /* @var \SportExperiment\Model\Eloquent\RiskAversionTreatment $riskAversionTreatment */
            $riskAversionTreatment = $this->subject->getRiskAversionTreatment();
            if ($riskAversionTreatment instanceof $nextTreatment) {
                if (count($this->subject->getRiskAversionEntries()) == 0) {
                    $view->with('isFirstEntry', true);
                }
                else {
                    $view->with('isFirstEntry', false);
                }

                $view->with('taskId', RiskAversionTreatment::getTaskId());
                $view->with('riskAversionTaskId', RiskAversionTreatment::getTaskId());
                $view->with('lowPrize', $riskAversionTreatment->getLowPrize());
                $view->with('highPrize', $riskAversionTreatment->getHighPrize());
                $view->with('endowment', $riskAversionTreatment->getEndowment());
                $view->with('gambleProbability', $riskAversionTreatment->getPrizeProbability());
                $view->with('gamblePayment', RiskAversionEntry::$GAMBLE_PAYMENT_KEY);
            }
            $view->with('displayRiskAversion', $riskAversionTreatment instanceof $nextTreatment);

            // Ultimatum Treatment
            $ultimatumTreatment = $this->subject->getUltimatumTreatment();
            if ($ultimatumTreatment instanceof $nextTreatment) {
                $view->with('taskId', UltimatumTreatment::getTaskId());
                $view->with('ultimatumTaskId', UltimatumTreatment::getTaskId());
                $view->with('ultimatumTotalAmount', $ultimatumTreatment->getTotalAmount());
                $view->with('isUltimatumProposer', $this->subject->getUltimatumGroup()->getSubjectRole() == UltimatumTreatment::getProposerRoleId());
                $view->with('amountKey', UltimatumEntry::$AMOUNT_KEY);
            }
            $view->with('displayUltimatum', $ultimatumTreatment instanceof $nextTreatment);

            // Trust Treatment
            $trustTreatment = $this->subject->getTrustTreatment();
            if ($trustTreatment instanceof $nextTreatment) {
                if (count($this->subject->getTrustEntries()) == 0) {
                    $view->with('isFirstEntry', true);
                }
                else {
                    $view->with('isFirstEntry', false);
                }
                $proposerAllocations = $this->composeProposerAllocations(
                    array_merge(['dev'=>'--'], $trustTreatment->getProposerAllocationOptions()));
                $view->with('taskId', TrustTreatment::getTaskId());
                $view->with('trustTaskId', TrustTreatment::getTaskId());
                $view->with('isTrustProposer', $this->subject->getTrustGroup()->getSubjectRole() == TrustTreatment::getProposerRoleId());
                $view->with('proposerAllocationOptions', $proposerAllocations);
                $view->with('receiverAllocationOptions', $trustTreatment->getReceiverAllocationOptions());
                $view->with('receiverMultiplier', $trustTreatment->getReceiverAllocationMultiplier());
                $view->with('numProposerAllocations', TrustTreatment::getNumProposerAllocations());
                $view->with('numReceiverAllocations', TrustTreatment::getNumReceiverAllocations());
                $view->with('allocationKey', TrustProposerEntry::$ALLOCATION_KEY);
            }
            $view->with('displayTrust', $trustTreatment instanceof $nextTreatment);

            // Dictator Treatment
            $dictatorTreatment = $this->subject->getDictatorTreatment();
            if ($dictatorTreatment instanceof $nextTreatment) {
                $chosenCharity = $this->subject->getCharity();
                if ($chosenCharity == null) {
                    $view->with('getCharity', true);
                    $view->with('charity', Charity::$CHARITY_KEY);
                }
                else {
                    $view->with('getCharity', false);
                    $view->with('charity', $chosenCharity->getCharity());
                }

                $view->with('charityOptions', array_merge(['default'=>'Select A Charity'], Charity::getCharities()));
                $view->with('taskId', DictatorTreatment::getTaskId());
                $view->with('dictatorTaskId', DictatorTreatment::getTaskId());
                $view->with('dictatorEndowment', $dictatorTreatment->getProposerEndowment());
                $view->with('dictatorAllocationKey', DictatorEntry::$DICTATOR_ALLOCATION_KEY);
            }
            $view->with('displayDictator', $dictatorTreatment instanceof $nextTreatment);
        }
        // Question Phase
        else {
            $view->with('displayTask', false);
            $view->with('surpriseLevel', GameQuestionnaireModel::$LEVEL_SURPRISE_KEY);
            $view->with('surpriseLevelOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], GameQuestionnaireModel::getOptionRange()));

            $view->with('excitationLevel', GameQuestionnaireModel::$LEVEL_EXCITATION_KEY);
            $view->with('excitationLevelOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], GameQuestionnaireModel::getOptionRange()));

            $view->with('happinessLevel', GameQuestionnaireModel::$LEVEL_HAPPINESS_KEY);
            $view->with('happinessLevelOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], GameQuestionnaireModel::getOptionRange()));

            $likelinessRange = array_combine(range(0, 100), range(0,100));
            $likelinessRange['default'] = 'Select A Chance Between 0 - 100';
            $view->with('likelinessWinningLevel', GameQuestionnaireModel::$LIKELINESS_WINNING_KEY);
            $view->with('likelinessWinningLevelOptions', $likelinessRange);
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