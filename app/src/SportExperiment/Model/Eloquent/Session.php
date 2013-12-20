<?php namespace SportExperiment\Model\Eloquent;

use SportExperiment\Model\TreatmentInterface;

class Session extends BaseEloquent
{
    public static $TABLE_KEY = 'experiment_sessions';

    public static $ID_KEY = 'id';
    public static $NUM_SUBJECTS_KEY = 'num_subjects';
    public static $STATE_KEY = 'state';

    public static $TASK_MINIMUM = 3;

    public static $STARTED_STATE = 1;
    public static $STOPPED_STATE = 2;

    protected $table;
    protected $fillable;
    protected $rules;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = []){
        $this->table = self::$TABLE_KEY;
        $this->fillable = [self::$NUM_SUBJECTS_KEY];

        $this->rules = [
            self::$NUM_SUBJECTS_KEY=>'required|integer|min:2|max:1000'];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany(Subject::getNamespace(), Subject::$SESSION_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function willingnessPay()
    {
        return $this->hasOne(WillingnessPayTreatment::getNamespace(), WillingnessPayTreatment::$SESSION_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function riskAversion()
    {
        return $this->hasOne(RiskAversionTreatment::getNamespace(), RiskAversionTreatment::$SESSION_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ultimatumTreatment()
    {
        return $this->hasOne(UltimatumTreatment::getNamespace(), UltimatumTreatment::$SESSION_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trustTreatment()
    {
        return $this->hasOne(TrustTreatment::getNamespace(), TrustTreatment::$SESSION_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dictatorTreatment()
    {
        return $this->hasOne(DictatorTreatment::getNamespace(), DictatorTreatment::$SESSION_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Validation
     * ---------------------------------------------------------------------*/

    /**
     * Sets the Session Id validation rules.
     */
    public function setIdValidationRule()
    {
        $this->rules[self::$ID_KEY] = ['required', 'integer', 'exists:experiment_sessions'];
    }

    /**
     * Sets the Session State validation rules.
     */
    public function setStateValidationRule()
    {
        $inSessionState = sprintf("in:%s,%s", self::$STARTED_STATE, self::$STOPPED_STATE);
        $this->rules[self::$STATE_KEY] = ['required', 'integer', $inSessionState];
    }

    /* ---------------------------------------------------------------------
     * Business Logic
     * ---------------------------------------------------------------------*/
    public function allSubjectsInHoldState()
    {
        $subjects = $this->getSubjects();
        foreach ($subjects as $subject) {
            if ( ! SubjectState::isPreGameHoldState($subject->getState())) {
                return false;
            }
        }
        return true;
    }

    public function isStartable()
    {
        return $this->allSubjectsInHoldState();
    }

    /**
     * Returns true if the all of the subjects in this session have made an entry
     * for each of their treatments.
     *
     * @return bool
     */
    public function isStoppable()
    {
        $riskAversionTreatment = $this->getRiskAversionTreatment();
        $willingnessPayTreatment = $this->getWillingnessPayTreatment();
        $ultimatumTreatment = $this->getUltimatumTreatment();
        $trustTreatment = $this->getTrustTreatment();
        $dictatorTreatment = $this->getDictatorTreatment();

        $subjects = $this->getSubjects();
        foreach($subjects as $subject) {
            if ($riskAversionTreatment != null) {
                if (count($subject->getRiskAversionEntries()) == 0)
                    return false;
            }

            if ($willingnessPayTreatment != null) {
                if (count($subject->getWillingnessPayEntries()) == 0)
                    return false;
            }

            if ($ultimatumTreatment != null) {
                if (count($subject->getUltimatumEntries()) == 0)
                    return false;
            }

            if ($trustTreatment != null) {
                if (count($subject->getTrustEntries()) == 0)
                    return false;
            }

            if ($dictatorTreatment != null) {
                if (count($subject->getDictatorEntries()) == 0)
                    return false;
            }
        }

        return true;
    }

    /**
     * Returns the active treatments for this session.
     *
     * @return \SportExperiment\Model\TreatmentInterface[]
     */
    public function getEnabledTreatments()
    {
        $riskAversionTreatment = $this->getRiskAversionTreatment();
        $willingnessPayTreatment = $this->getWillingnessPayTreatment();
        $ultimatumTreatment = $this->getUltimatumTreatment();
        $trustTreatment = $this->getTrustTreatment();
        $dictatorTreatment = $this->getDictatorTreatment();

        $treatments = [];
        if ($riskAversionTreatment != null)
            $treatments[] = $riskAversionTreatment;

        if ($willingnessPayTreatment != null)
            $treatments[] = $willingnessPayTreatment;

        if ($ultimatumTreatment != null)
            $treatments[] = $ultimatumTreatment;

        if ($trustTreatment != null)
            $treatments[] = $trustTreatment;

        if ($dictatorTreatment != null)
            $treatments[] = $dictatorTreatment;

        return $treatments;
    }

    /**
     * Returns the active treatments for this session.
     *
     * @param mixed $orderId
     * @return \SportExperiment\Model\TreatmentInterface
     */
    public function getTask($orderId)
    {
        $treatments = $this->getOrderedTasks();
        return $treatments[$orderId];
    }

    /**
     * Returns the active treatments ordered by Task Id.
     *
     * @return \SportExperiment\Model\TreatmentInterface[]
     */
    public function getOrderedTasks()
    {
        $treatments = $this->getEnabledTreatments();
        $orderedTreatments[] = $treatments[0];
        for ($i = 1; $i < count($treatments); ++$i) {
            for ($j = $i; $j > 0 && $treatments[$j]->getTreatmentTaskId() < $treatments[$j-1]->getTreatmentTaskId(); --$j) {
                $tempTreatment = $treatments[$j-1];
                $treatments[$j-1] = $treatments[$j];
                $treatments[$j] = $tempTreatment;
            }
        }

        return $treatments;
    }

    /**
     * Returns the next treatment following the previous treatment ID.
     *
     * @return \SportExperiment\Model\TreatmentInterface
     */
    public function getFirstTask()
    {
        $orderedTreatments = $this->getOrderedTasks();
        return $orderedTreatments[0];
    }

    /**
     * @param SubjectEntryState $entryState
     * @return null|\SportExperiment\Model\TreatmentInterface
     */
    public function getNextTask(SubjectEntryState $entryState)
    {
        $nextOrderId = $entryState->getOrderId() + 1;
        $treatments = $this->getOrderedTasks();
        if (isset($treatments[$nextOrderId])) {
            return $treatments[$nextOrderId];
        }

        return null;
    }


    /**
     * Returns a randomly selected treatment. If an $exceptTreatment parameter is
     * provided, that treatment is ignored.
     *
     * @param null|TreatmentInterface $exceptTreatment
     * @return int
     */
    private function getRandomTreatmentTaskId(TreatmentInterface $exceptTreatment = null)
    {
        if ($exceptTreatment != null) {
            $enabledTreatments = $this->getEnabledTreatments();
            $selectedTreatments = [];
            foreach($enabledTreatments as $treatment) {
                if ($treatment->getTreatmentTaskId() != $exceptTreatment->getTreatmentTaskId()) {
                    $selectedTreatments[] = $treatment;
                }
            }
        }
        else {
            $selectedTreatments = $this->getEnabledTreatments();
        }
        $randIndex = rand(0, count($selectedTreatments)-1);
        return $selectedTreatments[$randIndex]::getTaskId();
    }

    /**
     *  Calculates all subject payoffs.
     */
    public function calculatePayoffs()
    {
        $riskAversionTreatment = $this->getRiskAversionTreatment();
        $willingnessPayTreatment = $this->getWillingnessPayTreatment();
        $ultimatumTreatment = $this->getUltimatumTreatment();
        $trustTreatment = $this->getTrustTreatment();
        $dictatorTreatment = $this->getDictatorTreatment();

        $subjects = $this->getSubjects();

        /* -----------------------------------------------
         * Willingness Pay: Single Random Player Chosen
         * ----------------------------------------------- */
        $randomSubjectId = rand(0, count($subjects)-1);
        $willingnessPaySubject = $subjects[$randomSubjectId];
        if ($willingnessPayTreatment != null) {
            $willingnessPayTreatment->calculatePayoff($willingnessPaySubject);
            unset($subjects[$randomSubjectId]);
        }

        foreach($subjects as $subject) {
            $taskId = $this->getRandomTreatmentTaskId($willingnessPayTreatment);

            /* -------------------
             * Single Player
             * ------------------- */

            // Risk Aversion Payoff
            if ($riskAversionTreatment != null && $riskAversionTreatment::getTaskId() == $taskId ) {
                $riskAversionTreatment->calculatePayoff($subject);
            }


            /* -------------------
             * Multi Player
             * ------------------- */

            // Ultimatum Payoff
            if ($ultimatumTreatment != null && $ultimatumTreatment::getTaskId() == $taskId) {
                $ultimatumTreatment->calculatePayoff($subject);
            }

            // Trust Payoff
            if ($trustTreatment != null && $trustTreatment::getTaskId() == $taskId) {
                $trustTreatment->calculatePayoff($subject);
            }

            // Dictator Payoff
            if ($dictatorTreatment != null && $dictatorTreatment::getTaskId() == $taskId) {
                $dictatorTreatment->calculatePayoff($subject);
            }
        }
    }

    /**
     * Returns true if the session is in the stared state.
     *
     * @return bool
     */
    public function isStarted()
    {
        return $this->getState() == self::$STARTED_STATE;
    }

    /**
     * Returns true if the session is in the stopped state.
     *
     * @return bool
     */
    public function isStopped()
    {
        return $this->getState() == self::$STOPPED_STATE;
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/
    /**
     * @return Subject[]
     */
    public function getSubjects()
    {
        return $this->subjects;
    }
    /**
     * @return \SportExperiment\Model\Eloquent\TrustTreatment
     */
    public function getTrustTreatment()
    {
        return $this->trustTreatment;
    }

    /**
     * @return \SportExperiment\Model\Eloquent\UltimatumTreatment
     */
    public function getUltimatumTreatment()
    {
        return $this->ultimatumTreatment;
    }

    /**
     * @return \SportExperiment\Model\Eloquent\WillingnessPayTreatment
     */
    public function getWillingnessPayTreatment()
    {
        return $this->willingnessPay;
    }

    /**
     * @return \SportExperiment\Model\Eloquent\RiskAversionTreatment
     */
    public function getRiskAversionTreatment()
    {
        return $this->riskAversion;
    }

    /**
     * @return \SportExperiment\Model\Eloquent\DictatorTreatment
     */
    public function getDictatorTreatment()
    {
        return $this->dictatorTreatment;
    }

    /**
     * @param $state
     */
    public function setState($state)
    {
        $this->setAttribute(self::$STATE_KEY, $state);
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->getAttribute(self::$STATE_KEY);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->setAttribute(self::$ID_KEY, $id);
    }

    /**
     * @param mixed $numSubjects
     */
    public function setNumSubjects($numSubjects)
    {
        $this->setAttribute(self::$NUM_SUBJECTS_KEY, $numSubjects);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    /**
     * @return mixed
     */
    public function getNumSubjects()
    {
        return $this->getAttribute(self::$NUM_SUBJECTS_KEY);
    }
}