<?php namespace SportExperiment\Framework\Repository\Eloquent\Treatment;

use SportExperiment\Framework\Repository\Eloquent\Session;
use SportExperiment\Framework\Repository\Eloquent\BaseEloquent;

class RiskAversion extends BaseEloquent
{
    protected $table = 'risk_aversion_treatment';
    protected $fillable = array('session_id', 'low_prize', 'mid_prize', 'high_prize');

    public $session_id;
    public $low_prize;
    public $mid_prize;
    public $high_prize;

    /**
     * @return mixed
     */
    public function getHighPrize()
    {
        return $this->high_prize;
    }

    /**
     * @return mixed
     */
    public function getLowPrize()
    {
        return $this->low_prize;
    }

    /**
     * @return mixed
     */
    public function getMidPrize()
    {
        return $this->mid_prize;
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