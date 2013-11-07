<?php namespace SportExperiment\Repository\Eloquent\Subject;

class GameState
{
    public static $REGISTRATION = 1;
    public static $PRE_GAME_HOLD_STATE = 2;
    public static $GAME_PLAY = 3;
    public static $OUTGOING_QUESTIONNAIRE = 4;
    public static $PAYOFF = 5;
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
}