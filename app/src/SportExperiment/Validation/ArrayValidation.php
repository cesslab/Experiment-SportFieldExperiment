<?php namespace SportExperiment\Validation;

class ArrayValidation
{
    public function integerValues($field, $values, $params)
    {
        foreach ($values as $value) {
            if (filter_var($value, FILTER_VALIDATE_INT) == false)
               return false;
        }
        return true;
    }

    public function integerKeys($fields, $values, $params)
    {
        foreach ($values as $key=>$value) {
            if ( filter_var($key, FILTER_VALIDATE_INT) == false)
                return false;
        }
        return true;
    }

    public function hasKeyValues($fields, $values, $params)
    {
        $keys = array_keys($values);
        foreach($params as $param) {
            if ( ! in_array($param, $keys))
                return false;
        }

        return true;
    }

    public function hasValues($fields, $values, $params)
    {
        foreach($params as $param) {
            if ( ! in_array($param, $values))
                return false;
        }

        return true;

    }

}