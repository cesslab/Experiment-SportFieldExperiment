<?php namespace SportExperiment\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseEloquent extends Model
{
    /* @var \Illuminate\Support\Facades\Validator $validator */
    protected $validator;

    /* @var $rules array */
    protected $rules = [];

    /**
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }

    /**
     * Clears validation rules.
     */
    public function clearValidationRules()
    {
        $this->rules = [];
    }

    /**
     * Resets the validator with the most current attributes and validation rules.
     */
    private function updateValidator()
    {
        $this->validator = Validator::make($this->getAttributes(), $this->rules);
    }

    /**
     * @return mixed
     */
    public function validationFails()
    {
        $this->updateValidator();
        return $this->validator->fails();
    }

    /**
     * @return mixed
     */
    public function validationPasses()
    {
        $this->updateValidator();
        return $this->validator->passes();
    }

    /**
     * @return Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @return mixed
     */
    public function getErrorMessages()
    {
        return $this->validator->messages();
    }

    /**
     * @return string
     */
    public static function getNamespace()
    {
        return get_called_class();
    }

}