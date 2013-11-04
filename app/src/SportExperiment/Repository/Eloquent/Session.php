<?php namespace SportExperiment\Repository\Eloquent;

use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;

class Session extends BaseEloquent
{
    public static $TABLE_KEY = 'experiment_session';

    public static $ID_KEY = 'id';
    public static $NUM_SUBJECTS_KEY = 'num_subjects';

    protected $table;
    protected $fillable;
    protected $rules;

    public function __construct($attributes = array()){
        $this->table = self::$TABLE_KEY;
        $this->fillable = array(self::$NUM_SUBJECTS_KEY);
        $this->rules = array(self::$NUM_SUBJECTS_KEY=>'required|integer|min:1|max:1000');

        parent::__construct($attributes);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->setAttributes(self::$ID_KEY, $id);
    }

    /**
     * @param mixed $numSubjects
     */
    public function setNumSubjects($numSubjects)
    {
        $this->setAttributes(self::$NUM_SUBJECTS_KEY, $numSubjects);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getAttributes(self::$ID_KEY);
    }

    /**
     * @return mixed
     */
    public function getNumSubjects()
    {
        return $this->getAttributes(self::$NUM_SUBJECTS_KEY);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::getNamespace(), 'session_id');
    }

    public function willingnessPay()
    {
        return $this->hasOne(WillingnessPay::getNamespace(), 'session_id');
    }

    public function riskAversion()
    {
        return $this->hasOne(RiskAversion::getNamespace(), 'session_id');
    }
}