<?php namespace SportExperiment\Controller\Subject;

use Illuminate\Support\Facades\Auth;
use SportExperiment\Controller\BaseController;
use SportExperiment\Repository\SubjectRepositoryInterface;
use SportExperiment\View\Composer\Subject\Experiment as ExperimentComposer;
use Illuminate\Support\Facades\View;
use SportExperiment\Repository\Eloquent\Subject\RiskAversion;
use SportExperiment\Repository\Eloquent\Subject\WillingnessPay;
use Illuminate\Support\Facades\Input;
use SportExperiment\Repository\ModelCollection;
use Illuminate\Support\Facades\Redirect;

class Experiment extends BaseController
{
    public static $URI = 'subject/experiment';

    private $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
        View::composer(ExperimentComposer::$VIEW_PATH, ExperimentComposer::getNamespace());
    }

    public function getExperiment()
    {
        return View::make(ExperimentComposer::$VIEW_PATH);
    }

    public function postExperiment()
    {
        $modelCollection = new ModelCollection();

        $session = Auth::user()->subject->session;

        if ($session->willingnessPay != null)
            $modelCollection->addModel(new WillingnessPay(Input::all(), $session->willingnessPay->getEndowment()));

        if ($session->riskAversion != null)
            $modelCollection->addModel(new RiskAversion(Input::all()));

        if ($modelCollection->validationFails())
            return Redirect::to(self::$URI)->withInput()->with('errors', $modelCollection->getErrorMessages());

        $this->subjectRepository->saveSubjectData(Auth::user()->subject, $modelCollection);
        return Redirect::to(self::$URI);
    }
}