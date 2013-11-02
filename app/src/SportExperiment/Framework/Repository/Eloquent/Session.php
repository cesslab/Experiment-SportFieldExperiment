<?php namespace SportExperiment\Framework\Repository\Eloquent;

use SportExperiment\Framework\Repository\Eloquent\Treatment\WillingnessPay;
use SportExperiment\Framework\Repository\Eloquent\Treatment\RiskAversion;

class Session extends BaseEloquent
{
    protected $table = 'experiment_sessions';
    protected $fillable = array('num_subjects');

    public $id;
    public $num_subjects;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumSubjects()
    {
        return $this->num_subjects;
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