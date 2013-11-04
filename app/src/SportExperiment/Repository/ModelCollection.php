<?php namespace SportExperiment\Repository;

use Illuminate\Support\MessageBag;
use SportExperiment\Repository\Eloquent\BaseEloquent;

class ModelCollection {
    private $models;

    public function __construct($models = array())
    {
        $this->models = $models;
    }

    public function addModel(BaseEloquent $model)
    {
        $this->models[$model::getNamespace()] = $model;
    }

    public function validationFails()
    {
        $fails = false;
        foreach($this->models as $model) {
            if ($model->validationFails())
                $fails = true;
        }

        return $fails;
    }

    public function validationPasses()
    {
        $fails = false;
        foreach($this->models as $model) {
            if ($model->validationPasses())
                $fails = true;
        }

        return $fails;
    }

    public function getErrorMessages()
    {
        $messageBag = new MessageBag();
        foreach($this->models as $model) {
            $messageBag->merge($model->getValidator()->getMessageBag()->getMessages());
        }

        return $messageBag;
    }

    public function getModel($key)
    {
        if (isset($this->models[$key]))
            return $this->models[$key];
        return null;
    }
} 