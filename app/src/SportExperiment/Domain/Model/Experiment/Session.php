<?php namespace SportExperiment\Domain\Model\Experiment;

use SportExperiment\Domain\Model\BaseModel;

class Session extends BaseModel
{
    protected $rules = array(
        'num_subjects'=>'required|integer|min:1|max:1000');

    protected $whitelist = array('num_subjects');

    protected $num_subjects;

    public function __construct($properties = array())
    {
        parent::__construct($properties);
    }

    /**
     * @param mixed $num_subjects
     */
    public function setNumSubjects($num_subjects)
    {
        $this->num_subjects = $num_subjects;
    }

    /**
     * @return mixed
     */
    public function getNumSubjects()
    {
        return $this->num_subjects;
    }


}