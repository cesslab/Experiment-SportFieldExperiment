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
            if ($riskAversionTreatment !== null) {
                if (count($subject->getRiskAversionEntries()) == 0)
                    return false;
            }

            if ($willingnessPayTreatment !== null) {
                if (count($subject->getWillingnessPayEntries()) == 0)
                    return false;
            }

            if ($ultimatumTreatment !== null) {
                if (count($subject->getUltimatumEntries()) == 0)
                    return false;
            }

            if ($trustTreatment !== null) {
                if (count($subject->getTrustEntries()) == 0)
                    return false;
            }

            if ($dictatorTreatment !== null) {
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
        if ($riskAversionTreatment !== null)
            $treatments[] = $riskAversionTreatment;

        if ($willingnessPayTreatment !== null)
            $treatments[] = $willingnessPayTreatment;

        if ($ultimatumTreatment !== null)
            $treatments[] = $ultimatumTreatment;

        if ($trustTreatment !== null)
            $treatments[] = $trustTreatment;

        if ($dictatorTreatment !== null)
            $treatments[] = $dictatorTreatment;

        return $treatments;
    }

    /**
     * Returns the active treatments for this session.
     *
     * @param mixed $taskId
     * @return \SportExperiment\Model\TreatmentInterface
     */
    public function getEnabledTreatment($taskId)
    {
        $riskAversionTreatment = $this->getRiskAversionTreatment();
        $willingnessPayTreatment = $this->getWillingnessPayTreatment();
        $ultimatumTreatment = $this->getUltimatumTreatment();
        $trustTreatment = $this->getTrustTreatment();
        $dictatorTreatment = $this->getDictatorTreatment();

        if ($riskAversionTreatment !== null)
            if ($riskAversionTreatment->getTreatmentTaskId() == $taskId)
                return $riskAversionTreatment;

        if ($willingnessPayTreatment !== null)
            if ($willingnessPayTreatment->getTreatmentTaskId() == $taskId)
                return $willingnessPayTreatment;

        if ($ultimatumTreatment !== null)
            if ($ultimatumTreatment->getTreatmentTaskId() == $taskId)
                return $ultimatumTreatment;

        if ($trustTreatment !== null)
            if ($trustTreatment->getTreatmentTaskId() == $taskId)
                return $trustTreatment;

        if ($dictatorTreatment !== null)
            if ($dictatorTreatment->getTreatmentTaskId() == $taskId)
                return $dictatorTreatment;
    }

    /**
     * Returns the next treatment following the previous treatment ID.
     *
     * @return \SportExperiment\Model\TreatmentInterface
     */
    public function getFirstTreatment()
    {
        $treatments = $this->getEnabledTreatments();
        foreach ($treatments as $treatment) {
            if ($treatment->getTreatmentTaskId() > SubjectEntryState::$NO_TREATMENT_ID_SET) {
                return $treatment;
            }
        }

        return null;
    }

    /**
     * @param TreatmentInterface $currentTreatment
     * @return null|\SportExperiment\Model\TreatmentInterface
     */
    public function getNextTreatment(TreatmentInterface $currentTreatment)
    {
        $treatments = $this->getEnabledTreatments();
        foreach ($treatments as $treatment) {
            if ($treatment->getTreatmentTaskId() > $currentTreatment->getTreatmentTaskId()) {
                return $treatment;
            }
        }

        return null;
    }


    /**
     * Returns a randomly selected treatment for this session.
     *
     * @return int
     */
    private function getRandomTreatmentTaskId()
    {
        $enabledTreatments = $this->getEnabledTreatments();
        $randIndex = rand(0, count($enabledTreatments)-1);
        return $enabledTreatments[$randIndex]::getTaskId();
    }


    public function calculatePayoffs()
    {
        $riskAversionTreatment = $this->getRiskAversionTreatment();
        $willingnessPayTreatment = $this->getWillingnessPayTreatment();
        $ultimatumTreatment = $this->getUltimatumTreatment();
        $trustTreatment = $this->getTrustTreatment();
        $dictatorTreatment = $this->getDictatorTreatment();

        $subjects = $this->getSubjects();
        foreach($subjects as $subject) {
            $taskId = $this->getRandomTreatmentTaskId();

            /* -------------------
             * Single Player
             * ------------------- */

            // Risk Aversion Payoff
            if ($riskAversionTreatment !== null && $riskAversionTreatment::getTaskId() == $taskId ) {
                $riskAversionTreatment->calculatePayoff($subject);
            }

            // Willingness Pay Payoff
            if ($willingnessPayTreatment !== null && $willingnessPayTreatment::getTaskId() == $taskId) {
                $willingnessPayTreatment->calculatePayoff($subject);
            }

            /* -------------------
             * Multi Player
             * ------------------- */

            // Ultimatum Payoff
            if ($ultimatumTreatment !== null && $ultimatumTreatment::getTaskId() == $taskId) {
                $ultimatumTreatment->calculatePayoff($subject);
            }

            // Trust Payoff
            if ($trustTreatment !== null && $trustTreatment::getTaskId() == $taskId) {
                $trustTreatment->calculatePayoff($subject);
            }

            // Dictator Payoff
            if ($dictatorTreatment !== null && $dictatorTreatment::getTaskId() == $taskId) {
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