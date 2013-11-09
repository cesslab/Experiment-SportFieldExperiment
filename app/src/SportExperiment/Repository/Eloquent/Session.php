<?php namespace SportExperiment\Repository\Eloquent;

use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;

class Session extends BaseEloquent
{
    public static $TABLE_KEY = 'experiment_sessions';

    public static $ID_KEY = 'id';
    public static $NUM_SUBJECTS_KEY = 'num_subjects';
    public static $STATE_KEY = 'state';

    protected $table;
    protected $fillable;
    protected $rules;

    public function __construct($attributes = []){
        $this->table = self::$TABLE_KEY;
        $this->fillable = [self::$NUM_SUBJECTS_KEY];

        $this->rules = [
            self::$NUM_SUBJECTS_KEY=>'required|integer|min:1|max:1000'];

        parent::__construct($attributes);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::getNamespace(), Subject::$SESSION_ID_KEY);
    }

    public function willingnessPay()
    {
        return $this->hasOne(WillingnessPay::getNamespace(), WillingnessPay::$SESSION_ID_KEY);
    }

    public function riskAversion()
    {
        return $this->hasOne(RiskAversion::getNamespace(), RiskAversion::$SESSION_ID_KEY);
    }

    public function setState($state)
    {
        $this->setAttribute(self::$STATE_KEY, $state);
    }

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