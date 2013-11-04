<?php namespace SportExperiment\Filter;


abstract class BaseFilter {

    public static function getNamespace()
    {
        return get_called_class();
    }
}