<?php namespace SportExperiment\Domain\Model;


class BaseModel {
    protected $validator;
    protected $whitelist = array();

    public function __construct($properties = array())
    {
        foreach ($this->whitelist as $key) {
            if (isset($properties[$key])) {
                $this->$key = $properties[$key];
            }
        }

        $this->validator = \Validator::make($properties, $this->rules);
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

    public function toArray()
    {
        $properties = array();
        foreach($this->whitelist as $key) {
            $properties[$key] = $this->$key;
        }

        return $properties;
    }

} 