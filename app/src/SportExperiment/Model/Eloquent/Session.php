<?php namespace SportExperiment\Model\Eloquent;

class Session extends BaseEloquent
{
    public static $TABLE_KEY = 'experiment_sessions';

    public static $ID_KEY = 'id';
    public static $NUM_SUBJECTS_KEY = 'num_subjects';
    public static $STATE_KEY = 'state';

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
        }

        return true;
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
            // Risk Aversion Payoff
            if ($riskAversionTreatment !== null) {
                $riskAversionEntry = $riskAversionTreatment->calculatePayoff($subject);
                $riskAversionEntry->setSelectedForPayoff(true);
                $riskAversionEntry->save();
            }

            // Willingness Pay Payoff
            if ($willingnessPayTreatment !== null) {
                $willingnessPayEntry = $willingnessPayTreatment->calculatePayoff($subject);
                $willingnessPayEntry->setSelectedForPayoff(true);
                $willingnessPayEntry->save();
            }
        }

        // Ultimatum Payoff
        if ($ultimatumTreatment !== null) {
            $ultimatumGroups = $ultimatumTreatment->getGroups($subjects);
            foreach ($ultimatumGroups as $group) {
                $proposer = $group->getSubject(UltimatumTreatment::getProposerRoleId());
                $receiver = $group->getSubject(UltimatumTreatment::getReceiverRoleId());
                $ultimatumTreatment->calculateGroupPayoff($proposer, $receiver);
            }
        }

        // Trust Payoff
        if ($trustTreatment !== null) {
            $trustGroups = $trustTreatment->getGroups($subjects);
            foreach ($trustGroups as $group) {
                $proposer = $group->getSubject(TrustTreatment::getProposerRoleId());
                $receiver = $group->getSubject(TrustTreatment::getReceiverRoleId());
                $trustTreatment->calculateGroupPayoff($proposer, $receiver);
            }
        }

        // Dictator Payoff
        if ($dictatorTreatment !== null) {
            $dictatorGroups = $dictatorTreatment->getGroups($subjects);
            foreach ($dictatorGroups as $group) {
                $proposer = $group->getSubject(DictatorTreatment::getProposerRoleId());
                $receiver = $group->getSubject(DictatorTreatment::getReceiverRoleId());
                $dictatorTreatment->calculateGroupPayoff($proposer, $receiver);
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
     * @return TrustTreatment
     */
    public function getTrustTreatment()
    {
        return $this->trustTreatment;
    }

    /**
     * @return UltimatumTreatment
     */
    public function getUltimatumTreatment()
    {
        return $this->ultimatumTreatment;
    }

    /**
     * @return WillingnessPayTreatment
     */
    public function getWillingnessPayTreatment()
    {
        return $this->willingnessPay;
    }

    /**
     * @return RiskAversionTreatment
     */
    public function getRiskAversionTreatment()
    {
        return $this->riskAversion;
    }

    /**
     * @return DictatorTreatment
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