<?php namespace SportExperiment\Framework\Repository\Eloquent\Treatment;

use SportExperiment\Framework\Repository\Eloquent\BaseEloquent;
use SportExperiment\Framework\Repository\Eloquent\Session;

class WillingnessPay extends BaseEloquent
{
    protected $table = 'willingness_to_pay_treatment';
    protected $fillable = array('session_id', 'endowment');

    public $session_id;
    public $endowment;

    /**
     * @return mixed
     */
    public function getEndowment()
    {
        return $this->endowment;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), 'session_id');
    }
}