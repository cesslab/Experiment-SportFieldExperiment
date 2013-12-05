<?php namespace SportExperiment\Model\Eloquent;

class SubjectState
{
    public static $REGISTRATION = 1;
    public static $PRE_GAME_HOLD_STATE = 2;
    public static $GAME_PLAY = 3;
    public static $PAYOFF = 4;
    public static $OUTGOING_QUESTIONNAIRE = 5;
    public static $COMPLETED = 6;

    private $gameState;

    public function __construct($gameState)
    {
        $this->gameState = $gameState;
    }

    /**
     * @param mixed $gameState
     */
    public function setState($gameState)
    {
        $this->gameState = $gameState;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->gameState;
    }

    public static function isRegistrationState($state)
    {
        return $state == self::$REGISTRATION;
    }

    public static function isPreGameHoldState($state)
    {
        return $state == self::$PRE_GAME_HOLD_STATE;
    }

    public static function isGamePlayState($state)
    {
        return $state == self::$GAME_PLAY;
    }

    public static function isOutgoingQuestionnaireState($state)
    {
        return $state == self::$OUTGOING_QUESTIONNAIRE;
    }

    public static function isPayoffState($state)
    {
        return $state == self::$PAYOFF;
    }

    public static function isComplete($state)
    {
        return $state == self::$COMPLETED;
    }
}