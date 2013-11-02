<?php namespace SportExperiment\Domain\Model;

use Illuminate\Support\MessageBag;

class ModelCollection {
    private $models;

    public function __construct($models = array())
    {
        $this->models = $models;
    }

    public function addModel(BaseModel $model)
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

    /**
     * @return Illuminate\Support\MessageBag
     */
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