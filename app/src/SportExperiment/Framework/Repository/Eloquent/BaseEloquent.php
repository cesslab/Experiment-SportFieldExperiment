<?php namespace SportExperiment\Framework\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BaseEloquent extends Model
{
    public function __construct($attributes)
    {

    }

    public static function getNamespace()
    {
        return get_called_class();
    }
}