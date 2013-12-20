<?php namespace SportExperiment\Controller\Subject;

use Illuminate\Support\Facades\Auth;
use SportExperiment\Controller\BaseController;
use SportExperiment\Model\Eloquent\Charity;
use SportExperiment\Model\Eloquent\DictatorEntry;
use SportExperiment\Model\Eloquent\GameQuestionnaire;
use SportExperiment\Model\Eloquent\Good;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\SubjectEntryState;
use SportExperiment\Model\Eloquent\TrustProposerEntry;
use SportExperiment\Model\Eloquent\TrustReceiverEntry;
use SportExperiment\Model\Eloquent\UltimatumEntry;
use SportExperiment\Model\SubjectRepositoryInterface;
use SportExperiment\View\Composer\Subject\Experiment as ExperimentComposer;
use Illuminate\Support\Facades\View;
use SportExperiment\Model\Eloquent\RiskAversionEntry;
use SportExperiment\Model\Eloquent\WillingnessPayEntry;
use Illuminate\Support\Facades\Input;
use SportExperiment\Model\ModelCollection;
use Illuminate\Support\Facades\Redirect;
use SportExperiment\View\Composer\Subject\GameHold as GameHoldComposer;

class Experiment extends BaseController
{
    private static $URI = 'subject/experiment';

    private $subjectRepository;
    private $subject;

    public function __construct(SubjectRepositoryInterface $subjectRepository, Subject $subject)
    {
        $this->subjectRepository = $subjectRepository;
        $this->subject = $subject;
        View::composer(ExperimentComposer::$VIEW_PATH, ExperimentComposer::getNamespace());
        View::composer(GameHoldComposer::$VIEW_PATH, GameHoldComposer::getNamespace());
    }

    public function getExperiment()
    {
        return View::make(ExperimentComposer::$VIEW_PATH);
    }

    public function postExperiment()
    {
        $entryState = $this->subject->getSubjectEntryState();

        // Handle Treatment Submission
        if ( $entryState->getTaskEntryState() == SubjectEntryState::$TASK_ENTRIES_REQUIRED) {

            $currentTreatment = $this->subject->getSession()->getTask($entryState->getOrderId());

            $modelCollection = new ModelCollection();
            $session = $this->subject->getSession();

            // Willingness to pay treatment
            $chosenGood = null;
            if ($session->getWillingnessPayTreatment() instanceof $currentTreatment) {
                $chosenGood = $this->subject->getGood();
                if ($chosenGood == null) {
                    $good = new Good(Input::all());
                    $modelCollection->addModel($good);
                }
                $modelCollection->addModel(
                    new WillingnessPayEntry(Input::all(), $session->getWillingnessPayTreatment()->getEndowment()));
            }

            // Risk aversion treatment
            if ($session->getRiskAversionTreatment() instanceof $currentTreatment) {
                $riskAversionEntry = new RiskAversionEntry(Input::all());
                $riskAversionEntry->setMaxGamblePayment($session->getRiskAversionTreatment()->getEndowment());
                $modelCollection->addModel($riskAversionEntry);
            }

            // Ultimatum treatment
            if ($session->getUltimatumTreatment() instanceof $currentTreatment) {
                $ultimatumEntry = new UltimatumEntry(Input::all());
                $ultimatumEntry->setMaxAmountRule($this->subject->getUltimatumTreatment()->getTotalAmount());
                $modelCollection->addModel($ultimatumEntry);
            }

            // Trust treatment
            if ($session->getTrustTreatment() instanceof $currentTreatment) {
                $trustEntry = ($this->subject->getTrustGroup()->isProposer()) ? new TrustProposerEntry(Input::all()) : new TrustReceiverEntry(Input::all());
                $trustEntry->setValidationRules($this->subject->getTrustTreatment());
                $modelCollection->addModel($trustEntry);
            }

            // Dictator treatment
            $chosenCharity = null;
            if ($session->getDictatorTreatment() instanceof $currentTreatment) {
                $chosenCharity = $this->subject->getCharity();
                if ($chosenCharity == null) {
                    $charity = new Charity(Input::all());
                    $modelCollection->addModel($charity);
                }
                $dictatorEntry = new DictatorEntry(Input::all());
                $dictatorEntry->setMaxAllocationRule($session->getDictatorTreatment()->getProposerEndowment());
                $modelCollection->addModel($dictatorEntry);
            }

            if ($modelCollection->validationFails())
                return Redirect::to(self::getRoute())->withInput()->with('errors', $modelCollection->getErrorMessages());

            // Save Treatment
            $this->subjectRepository->saveSubjectData(Auth::user()->subject, $modelCollection, $currentTreatment);

            // Update SubjectEntryState
            $nextTask = $this->subject->getSession()->getNextTask($entryState);
            if ($nextTask == null) {
                $firstTask = $this->subject->getSession()->getFirstTask();
                $entryState->setTaskId($firstTask->getTreatmentTaskId());
                $entryState->setOrderId(SubjectEntryState::$FIRST_TASK);
                $entryState->setTaskEntryState(SubjectEntryState::$TASK_ENTRIES_COMPLETE);
            }
            else {
                $entryState->setTaskId($nextTask->getTreatmentTaskId());
                $entryState->setOrderId($entryState->getNextOrderId());
                $entryState->setTaskId($nextTask->getTreatmentTaskId());
            }
            $entryState->save();

            return Redirect::to(self::getRoute());
        }
        // Handle Question Submission
        else {
            $gameQuestionnaire = new GameQuestionnaire(Input::all());
            if ($gameQuestionnaire->validationFails())
                return Redirect::to(self::getRoute())->withInput()->with('errors', $gameQuestionnaire->getErrorMessages());

            $gameQuestionnaire->subject()->associate($this->subject);
            $gameQuestionnaire->save();

            // Update SubjectEntryState
            $entryState->setTaskEntryState(SubjectEntryState::$TASK_ENTRIES_REQUIRED);
            $entryState->save();

            return View::make(GameHoldComposer::$VIEW_PATH);
        }

    }

    public static function getRoute()
    {
        return self::$URI;
    }
}