<?php namespace SportExperiment\Controller\Subject;

use SportExperiment\Controller\BaseController;
use SportExperiment\Repository\Eloquent\Subject\GameState;
use SportExperiment\Repository\SubjectRepositoryInterface;
use SportExperiment\View\Composer\Subject\Registration as DemographicComposer;
use \Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SportExperiment\Controller\Subject\Experiment as ExperimentController;

class Registration extends BaseController
{
    public static $URI = 'subject/registration';

    private $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
        View::composer(DemographicComposer::$VIEW_PATH, DemographicComposer::getNamespace());
    }

    public function getRegistration()
    {
        return View::make(DemographicComposer::$VIEW_PATH);
    }

    public function postRegistration()
    {
        $subject = Auth::user()->subject;
        $subject->fill(Input::all());
        if ($subject->validationFails())
            return Redirect::to(self::$URI)->with('errors', $subject->getErrorMessages());

        $subject->setGameState(new GameState(GameState::$PRE_GAME_HOLD_STATE));
        $subject->save();
        return Redirect::to(ExperimentController::$URI);
    }
}
