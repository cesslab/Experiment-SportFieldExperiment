<?php namespace SportExperiment\Domain\Model\Experiment\Treatment;


use SportExperiment\Domain\Model\BaseModel;

class WillingnessPay extends BaseModel
{
    protected $rules = array('endowment'=>'required|integer|min:1|max:1000000');
    protected $whitelist = array('endowment');

    private $endowment;

    public function __construct($properties = array())
    {
        parent::__construct($properties);
    }
}