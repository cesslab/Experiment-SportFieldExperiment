<?php namespace SportExperiment\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseEloquent extends Model
{
    protected $rules = [];

    /* @var \Illuminate\Support\Facades\Validator; $validator */
    protected $validator;

    public function __construct($attributes)
    {
        $this->validator = Validator::make($attributes, $this->rules);
        parent::__construct($attributes);
    }

    public function validationFails()
    {
        $this->updateValidatorData();
        return $this->validator->fails();
    }

    public function validationPasses()
    {
        $this->updateValidatorData();
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

    public static function getNamespace()
    {
        return get_called_class();
    }

    private function updateValidatorData()
    {
        $this->validator->setData($this->getAttributes());
    }
}