<?php namespace SportExperiment\Validation;

use Illuminate\Support\Facades\Validator;

class BaseValidator
{
    /* @var $validator \Illuminate\Validation\Validator */
    protected $validator;

    public function __construct($rules)
    {
        $this->validator = Validator::make([], $rules);
    }

    public function validationFails()
    {
        return $this->validator->fails();
    }

    public function validationPasses()
    {
        return $this->validator->passes();
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function getErrorMessages()
    {
        return $this->validator->messages();
    }

    public function setData(array $data)
    {
        $this->validator->setData($data);
    }

    public function getData()
    {
        return $this->validator->getData();
    }

    public function getRules()
    {
        return $this->validator->getRules();
    }
}