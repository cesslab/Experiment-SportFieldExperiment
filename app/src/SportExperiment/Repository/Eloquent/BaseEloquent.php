<?php namespace SportExperiment\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseEloquent extends Model
{
    protected $rules;
    protected $validator;

    public function __construct($attributes)
    {
        parent::__construct($attributes);

        $this->validator = Validator::make($attributes, $this->rules);
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

    public static function getNamespace()
    {
        return get_called_class();
    }
}