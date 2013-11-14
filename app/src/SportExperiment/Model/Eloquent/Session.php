<?php namespace SportExperiment\Model\Eloquent;

class Session extends BaseEloquent
{
    public static $TABLE_KEY = 'experiment_sessions';

    public static $ID_KEY = 'id';
    public static $NUM_SUBJECTS_KEY = 'num_subjects';
    public static $STATE_KEY = 'state';

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
            self::$NUM_SUBJECTS_KEY=>'required|integer|min:1|max:1000'];

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

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

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