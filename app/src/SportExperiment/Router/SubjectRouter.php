<?php namespace SportExperiment\Router;

use SportExperiment\Controller\Researcher\Login;
use SportExperiment\Controller\Subject\Registration;
use SportExperiment\Controller\Subject\PreGameHold;
use SportExperiment\Controller\Subject\Experiment;
use SportExperiment\Repository\Eloquent\Subject;
use SportExperiment\Repository\Eloquent\SessionState;
use Illuminate\Support\Facades\Route;
use SportExperiment\Repository\Eloquent\SubjectState;
use SportExperiment\Controller\Subject\Payoff;

class SubjectRouter {
    private $route;

    public function __construct()
    {
        $this->route = array(
            SubjectState::$REGISTRATION=>Registration::getRoute(),
            SubjectState::$PRE_GAME_HOLD_STATE=>PreGameHold::getRoute(),
            SubjectState::$GAME_PLAY=>Experiment::getRoute(),
            SubjectState::$COMPLETED=>Login::getRoute(),
            // TODO: Add the remaining game states
            SubjectState::$PAYOFF=>Payoff::getRoute(),
            SubjectState::$OUTGOING_QUESTIONNAIRE=>0,
            SubjectState::$COMPLETED=>0
        );
    }

    public function getGameStateRoute($state)
    {
        return $this->route[$state->getState()];
    }

    public function isCurrentRouteValid(Subject $subject)
    {
        $currentRoute = Route::getCurrentRoute()->getPath();
        $subjectStateRoute = '/' . $this->getRoute($subject);
        return $subjectStateRoute === $currentRoute;
    }

    public function getRoute(Subject $subject)
    {
        $sessionState = $subject->session->getState();
        $subjectGameState = $subject->getState();

        /*
         * The subject's game state is auto transitioned in two cases:
         */
        if (SubjectState::isPreGameHoldState($subjectGameState) && SessionState::isStartedState($sessionState)) {
            $subject->setState(SubjectState::$GAME_PLAY);
            $subject->save();
            return $this->route[SubjectState::$GAME_PLAY];
        }
        if (SubjectState::isGamePlayState($subjectGameState) && SessionState::isStoppedState($sessionState)) {
            $subject->setState(SubjectState::$PAYOFF);
            $subject->save();
            return $this->route[SubjectState::$PAYOFF];
        }

        return $this->route[$subjectGameState];
    }
}