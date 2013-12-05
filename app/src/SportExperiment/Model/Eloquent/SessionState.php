<?php namespace SportExperiment\Model\Eloquent;

use SportExperiment\Validation\BaseValidator;

class SessionState extends BaseValidator
{
    public static $STARTED = 1;
    public static $STOPPED = 2;

    public function __construct()
    {
        $inSessionState = sprintf("in:%s,%s", self::$STARTED, self::$STOPPED);
        $rules = [Session::$STATE_KEY=>['required', 'integer', $inSessionState]];

        parent::__construct($rules);
    }

    public function setState($state)
    {
        $this->setData([Session::$STATE_KEY=>$state]);
    }

    public function getState()
    {
        $data = $this->getData(Session::$STATE_KEY);
        if (isset($data[Session::$STATE_KEY]))
            return $data[Session::$STATE_KEY];

        return null;
    }

    public static function getKey()
    {
        return Session::$STATE_KEY;
    }

    public static function isStoppedState($state)
    {
        return $state == self::$STOPPED;
    }

    public static function isStartedState($state)
    {
        return $state == self::$STARTED;
    }
}