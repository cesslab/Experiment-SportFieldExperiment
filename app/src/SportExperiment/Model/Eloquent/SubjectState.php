<?php namespace SportExperiment\Model\Eloquent;

class SubjectState
{
    public static $REGISTRATION = 1;
    public static $PRE_GAME_QUESTIONNAIRE_STATE = 2;
    public static $PRE_GAME_HOLD_STATE = 3;
    public static $GAME_PLAY = 4;
    public static $PAYOFF = 5;
    public static $OUTGOING_QUESTIONNAIRE = 6;
    public static $COMPLETED = 7;

    private $gameState;

    /**
     * @param $gameState
     */
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

    /**
     * Returns true if the provided state is the Registration State.
     *
     * @param $state
     * @return bool
     */
    public static function isRegistrationState($state)
    {
        return $state == self::$REGISTRATION;
    }

    /**
     * Returns true if the provided state is the Pre-Game Hold State.
     *
     * @param $state
     * @return bool
     */
    public static function isPreGameHoldState($state)
    {
        return $state == self::$PRE_GAME_HOLD_STATE;
    }

    /**
     * Returns true if the provided state is the Game Play State.
     *
     * @param $state
     * @return bool
     */
    public static function isGamePlayState($state)
    {
        return $state == self::$GAME_PLAY;
    }

    /**
     * Returns true if the provided state is the Outgoing Questionnaire State.
     *
     * @param $state
     * @return bool
     */
    public static function isOutgoingQuestionnaireState($state)
    {
        return $state == self::$OUTGOING_QUESTIONNAIRE;
    }

    /**
     * Returns true if the provided state is the Payoff State.
     *
     * @param $state
     * @return bool
     */
    public static function isPayoffState($state)
    {
        return $state == self::$PAYOFF;
    }

    /**
     * Returns true if the current state is the Completed State.
     *
     * @param $state
     * @return bool
     */
    public static function isComplete($state)
    {
        return $state == self::$COMPLETED;
    }

    /**
     * Returns true if the current state is the Pre-Game Questionnaire State.
     * @param $state
     * @return bool
     */
    public static function isPreGameQuestionnaireState($state)
    {
        return $state == self::$PRE_GAME_QUESTIONNAIRE_STATE;
    }
}