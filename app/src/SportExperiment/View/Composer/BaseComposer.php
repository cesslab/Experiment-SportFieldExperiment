<?php namespace SportExperiment\View\Composer;

class BaseComposer
{
    public static function getNamespace()
    {
        return get_called_class();
    }
}
