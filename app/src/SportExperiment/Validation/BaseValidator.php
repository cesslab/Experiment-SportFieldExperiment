<?php namespace SportExperiment\Validation;

use Illuminate\Support\Facades\Validator;

class BaseValidator
{
    /* @var $validator \Illuminate\Validation\Validator */
    protected $validator;

    /* @var $rules array */
    protected $rules;

    /**
     * @param $rules
     */
    public function __construct($rules)
    {
        $this->validator = Validator::make([], $rules);
    }

    /**
     * Clears validation rules.
     */
    public function clearValidationRules()
    {
        $this->rules = [];
    }

    /**
     * @return bool
     */
    public function validationFails()
    {
        return $this->validator->fails();
    }

    /**
     * @return bool
     */
    public function validationPasses()
    {
        return $this->validator->passes();
    }

    /**
     * @return \Illuminate\Validation\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrorMessages()
    {
        return $this->validator->messages();
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->validator->setData($data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->validator->getData();
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->validator->getRules();
    }
}