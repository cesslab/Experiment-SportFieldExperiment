<?php namespace SportExperiment\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseEloquent extends Model
{
    protected $rules = [];

    /* @var \Illuminate\Support\Facades\Validator $validator */
    protected $validator;

    /**
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);
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

    /**
     * Resets the validator with the most current attributes and validation rules.
     */
    private function updateValidator()
    {
        $this->validator = Validator::make($this->getAttributes(), $this->rules);
    }
}