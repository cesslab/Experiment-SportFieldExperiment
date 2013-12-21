<?php namespace SportExperiment\Model\Eloquent;

class Subject extends BaseEloquent
{
    public static $TABLE_KEY = 'subjects';

    public static $ID_KEY = 'id';
    public static $GAME_STATE_KEY = 'game_state';
    public static $USER_ID_KEY = 'user_id';
    public static $FIRST_NAME_KEY = 'first_name';
    public static $LAST_NAME_KEY = 'last_name';
    public static $SESSION_ID_KEY = 'session_id';
    public static $EDUCATION_KEY = 'education';
    public static $GENDER_KEY = 'gender';
    public static $AGE_KEY = 'age';
    public static $WORK_STATUS_KEY = 'work_status';
    public static $INCOME_KEY = 'income';

    private static $workStatusOptions = [
        'unemployed'=>'Unemployed', 'full'=>'Full Time','part'=>'Part Time', 'student'=>'Student'];

    private static $incomeOptions = [
        'low'=>'below $2500', 'low_mid'=>'$25,000 to $49,999', 'high_mid'=>'$50,000 to $99,999', 'high'=>'$100,000 and Above'];

    private static $educationOptions = [
        'no_hs'=>'Did Not Complete High School', 'hs_ged'=>'High School or GED', 'some_bs'=>'Some College',
        'bs'=>'Bachelor\'s Degree', 'ms'=>'Master\'s Degree', 'phd'=>'Ph.D.'];

    protected $rules;
    protected $table;
    protected $fillable;

    public function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;
        $this->rules = [
            self::$FIRST_NAME_KEY=>['required', 'alpha', 'min:2', 'max:100'],
            self::$LAST_NAME_KEY=>['required', 'alpha', 'min:2', 'max:100'],
            self::$EDUCATION_KEY=>['required', 'in:no_hs,hs_ged,some_bs,bs,ms,phd'],
            self::$GENDER_KEY=>['required', 'in:male,female'],
            self::$AGE_KEY=>['required','integer', 'in:'. implode(',', range(18, 100))],
            self::$WORK_STATUS_KEY=>['required', 'in:full,part,unemployed,student'],
            self::$INCOME_KEY=>['required', 'in:low,low_mid,high_mid,high']
        ];

        $this->fillable = [
            self::$FIRST_NAME_KEY, self::$LAST_NAME_KEY, self::$EDUCATION_KEY, self::$GENDER_KEY,
            self::$AGE_KEY, self::$WORK_STATUS_KEY, self::$INCOME_KEY];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function charity()
    {
        return $this->hasOne(Charity::getNamespace(), Charity::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function good()
    {
        return $this->hasOne(Good::getNamespace(), Good::$SUBJECT_ID_KEY);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subjectEntryState()
    {
        return $this->hasOne(SubjectEntryState::getNamespace(), SubjectEntryState::$SUBJECT_ID_KEY);
    }

    public function gameQuestionnaire()
    {
        return $this->hasOne(GameQuestionnaire::getNamespace(), GameQuestionnaire::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function preGameQuestionnaire()
    {
        return $this->hasOne(PreGameQuestionnaire::getNamespace(), PreGameQuestionnaire::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ultimatumGroup()
    {
        return $this->hasOne(UltimatumGroup::getNamespace(), UltimatumGroup::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dictatorGroup()
    {
        return $this->hasOne(DictatorGroup::getNamespace(), DictatorGroup::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trustGroup()
    {
        return $this->hasOne(TrustGroup::getNamespace(), TrustGroup::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ultimatumEntries()
    {
        return $this->hasMany(UltimatumEntry::getNamespace(), UltimatumEntry::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function riskAversionEntries()
    {
        return $this->hasMany(RiskAversionEntry::getNamespace(), RiskAversionEntry::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function willingnessPayEntries()
    {
        return $this->hasMany(WillingnessPayEntry::getNamespace(), WillingnessPayEntry::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trustEntries()
    {
        return $this->hasMany(TrustEntry::getNamespace(), TrustEntry::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dictatorEntries()
    {
        return $this->hasMany(DictatorEntry::getNamespace(), DictatorEntry::$SUBJECT_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::getNamespace(), self::$USER_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), self::$SESSION_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Business Logic
     * ---------------------------------------------------------------------*/

    /**
     * @return bool
     */
    public function isPayoffSet()
    {
        $riskAversionEntries = $this->getRiskAversionEntries();
        if ($riskAversionEntries != null && count($riskAversionEntries) > 0) {
            foreach ($riskAversionEntries as $entry) {
                if ($entry->getSelectedForPayoff())
                    return true;
            }
        }

        $willingnessPayEntries = $this->getWillingnessPayEntries();
        if ($willingnessPayEntries != null && count($willingnessPayEntries) > 0) {
            foreach ($willingnessPayEntries as $entry) {
                if ($entry->getSelectedForPayoff())
                    return true;
            }
        }
    }

    /**
     * @return RiskAversionEntry
     */
    public function getRandomRiskAversionEntry()
    {
        $entries = $this->getRiskAversionEntries();
        $randIndex = rand(0, count($entries)-1);
        return $entries[$randIndex];
    }

    /**
     * @return WillingnessPayEntry
     */
    public function getRandomWillingnessPayEntry()
    {
        $entries = $this->getWillingnessPayEntries();
        $randIndex = rand(0, count($entries)-1);
        return $entries[$randIndex];
    }

    /**
     * @return UltimatumEntry
     */
    public function getRandomUltimatumEntry()
    {
        $entries = $this->getUltimatumEntries();
        $randIndex = rand(0, count($entries)-1);
        return $entries[$randIndex];
    }

    /**
     * @return TrustEntry
     */
    public function getRandomTrustEntry()
    {
        $entries = $this->getTrustEntries();
        $randIndex = rand(0, count($entries)-1);
        return $entries[$randIndex];
    }

    /**
     * @return DictatorEntry
     */
    public function getRandomDictatorEntry()
    {
        $entries = $this->getDictatorEntries();
        $randIndex = rand(0, count($entries)-1);
        return $entries[$randIndex];
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * Returns the subject work status options.
     *
     * @return array
     */
    public static function getWorkStatusOptions()
    {
        return self::$workStatusOptions;
    }

    /**
     * Returns the subject income options.
     *
     * @return array
     */
    public static function getIncomeOptions()
    {
        return self::$incomeOptions;
    }

    /**
     * Returns the subjects education options.
     *
     * @return array
     */
    public static function getEducationOptions()
    {
        return self::$educationOptions;
    }

    /**
     * @return SubjectEntryState
     */
    public function getSubjectEntryState()
    {
        return $this->subjectEntryState;
    }

    /**
     * @return UltimatumGroup
     */
    public function getUltimatumGroup()
    {
        return $this->ultimatumGroup;
    }

    /**
     * @return TrustGroup
     */
    public function getTrustGroup()
    {
        return $this->trustGroup;
    }

    /**
     * @return DictatorGroup
     */
    public function getDictatorGroup()
    {
        return $this->dictatorGroup;
    }

    /**
     * @return Charity
     */
    public function getCharity()
    {
        return $this->charity;
    }

    /**
     * @return Good
     */
    public function getGood()
    {
        return $this->good;
    }

    /**
     * @return RiskAversionEntry
     */
    public function getRiskAversionPayoff()
    {
        return $this->riskAversionEntries()->where(RiskAversionEntry::$SELECTED_FOR_PAYOFF, '=', true)->first();
    }

    /**
     * @return WillingnessPayEntry
     */
    public function getWillingnessPayPayoff()
    {
        return $this->willingnessPayEntries()->where(WillingnessPayEntry::$SELECTED_FOR_PAYOFF, '=', true)->first();
    }

    /**
     * @return UltimatumEntry
     */
    public function getUltimatumPayoff()
    {
        return $this->ultimatumEntries()->where(UltimatumEntry::$SELECTED_FOR_PAYOFF, '=', true)->first();
    }

    /**
     * @return TrustEntry
     */
    public function getTrustPayoff()
    {
        return $this->trustEntries()->where(TrustEntry::$SELECTED_FOR_PAYOFF, '=', true)->first();
    }

    /**
     * @return DictatorEntry
     */
    public function getDictatorPayoff()
    {
        return $this->dictatorEntries()->where(DictatorEntry::$SELECTED_FOR_PAYOFF, '=', true)->first();
    }


    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return \SportExperiment\Model\TreatmentInterface[]
     */
    public function getTreatments()
    {
        return $this->getSession()->getEnabledTreatments();
    }

    /**
     * @param $taskId
     * @return \SportExperiment\Model\TreatmentInterface
     */
    public function getTreatment($taskId)
    {
        return $this->getSession()->getTask($taskId);
    }

    /**
     * @return \SportExperiment\Model\TreatmentInterface
     */
    public function getFirstTreatment()
    {
        return $this->getSession()->getFirstTask();
    }

    /**
     * @return \SportExperiment\Model\Eloquent\UltimatumTreatment
     */
    public function getUltimatumTreatment()
    {
        return $this->getSession()->getUltimatumTreatment();
    }

    /**
     * @return WillingnessPayTreatment
     */
    public function getWillingnessPayTreatment()
    {
        return $this->getSession()->getWillingnessPayTreatment();
    }

    /**
     * @return RiskAversionTreatment
     */
    public function getRiskAversionTreatment()
    {
        return $this->getSession()->getRiskAversionTreatment();
    }

    /**
     * @return TrustTreatment
     */
    public function getTrustTreatment()
    {
        return $this->getSession()->getTrustTreatment();
    }

    /**
     * @return DictatorTreatment
     */
    public function getDictatorTreatment()
    {
        return $this->getSession()->getDictatorTreatment();
    }

    /**
     * @return UltimatumEntry[]
     */
    public function getUltimatumEntries()
    {
        return $this->ultimatumEntries;
    }

    /**
     * @return DictatorEntry[]
     */
    public function getDictatorEntries()
    {
        return $this->dictatorEntries;
    }


    /**
     * @return TrustEntry[]
     */
    public function getTrustEntries()
    {
        return $this->trustEntries;
    }

    /**
     * @return RiskAversionEntry[]
     */
    public function getRiskAversionEntries()
    {
        return $this->riskAversionEntries;
    }

    /**
     * @return WillingnessPayEntry[]
     */
    public function getWillingnessPayEntries()
    {
        return $this->willingnessPayEntries;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->setAttribute(self::$ID_KEY, $id);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    /**
     * @param mixed $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->setAttribute(self::$ID_KEY, $sessionId);
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->setAttribute(self::$AGE_KEY, $age);
    }

    /**
     * @param mixed $education
     */
    public function setEducation($education)
    {
        $this->setAttribute(self::$EDUCATION_KEY, $education);
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->setAttribute(self::$FIRST_NAME_KEY, $firstName);
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->setAttribute(self::$GENDER_KEY, $gender);
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->setAttribute(self::$LAST_NAME_KEY, $lastName);
    }

    /**
     * @param $subjectGameState
     */
    public function setState($subjectGameState)
    {
        $this->setAttribute(self::$GAME_STATE_KEY, $subjectGameState);
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->getAttribute(self::$GAME_STATE_KEY);
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->getAttribute(self::$AGE_KEY);
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->getAttribute(self::$EDUCATION_KEY);
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->getAttribute(self::$FIRST_NAME_KEY);
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->getAttribute(self::$GENDER_KEY);
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->getAttribute(self::$LAST_NAME_KEY);
    }
}