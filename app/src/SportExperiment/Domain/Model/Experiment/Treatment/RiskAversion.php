<?php namespace SportExperiment\Domain\Model\Experiment\Treatment;

use SportExperiment\Domain\Model\BaseModel;

class RiskAversion extends BaseModel
{
    protected $rules = array(
        'low_prize'=>'required|integer|min:1|max:1000000',
        'mid_prize'=>'required|integer|min:1|max:1000000',
        'high_prize'=>'required|integer|min:1|max:1000000',
    );

    protected $whitelist = array('low_prize', 'mid_prize', 'high_prize');

    protected $low_prize;
    protected $mid_prize;
    protected  $high_prize;

    public function __construct($properties = array())
    {
        parent::__construct();
    }

    /**
     * @param mixed $mid_prize
     */
    public function setMidPrize($mid_prize)
    {
        $this->mid_prize = $mid_prize;
    }

    /**
     * @return mixed
     */
    public function getMidPrize()
    {
        return $this->mid_prize;
    }

    /**
     * @param mixed $low_prize
     */
    public function setLowPrize($low_prize)
    {
        $this->low_prize = $low_prize;
    }

    /**
     * @return mixed
     */
    public function getLowPrize()
    {
        return $this->low_prize;
    }

    /**
     * @param mixed $high_prize
     */
    public function setHighPrize($high_prize)
    {
        $this->high_prize = $high_prize;
    }

    /**
     * @return mixed
     */
    public function getHighPrize()
    {
        return $this->high_prize;
    }

} 