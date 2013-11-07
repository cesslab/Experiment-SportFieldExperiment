<?php namespace SportExperiment\Router;

use SportExperiment\Controller\Researcher\Login;
use SportExperiment\Repository\Eloquent\Subject\GameState;
use SportExperiment\Controller\Subject\Registration;
use SportExperiment\Controller\Subject\PreGameHold;
use SportExperiment\Controller\Subject\Experiment;
use SportExperiment\Repository\Eloquent\Subject;

class SubjectRouter {
    private $route;

    public function __construct()
    {
        $this->route = array(
            GameState::$REGISTRATION=>Registration::$URI,
            GameState::$PRE_GAME_HOLD_STATE=>PreGameHold::$URI,
            GameState::$GAME_PLAY=>Experiment::$URI,
            GameState::$COMPLETED=>Login::$URI
            // TODO: Add the remaining game states
        );
    }

    public function getGameStateRoute(GameState $state)
    {
        return $this->route[$state->getState()];
    }

    public function isValidRoute(Subject $subject, $route)
    {
        $gameStateRoute = '/' . $this->getGameStateRoute(new GameState($subject->getGameState()));
        return $gameStateRoute === $route;
    }

    public function getRoute(Subject $subject)
    {
        $gameState = new GameState($subject->getGameState());
        return $this->route[$gameState->getState()];
    }

}