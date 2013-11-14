<?php namespace SportExperiment\Controller\Subject;

use Illuminate\Support\Facades\Auth;
use SportExperiment\Controller\BaseController;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\UltimatumEntry;
use SportExperiment\Model\SubjectRepositoryInterface;
use SportExperiment\View\Composer\Subject\Experiment as ExperimentComposer;
use Illuminate\Support\Facades\View;
use SportExperiment\Model\Eloquent\RiskAversionEntry;
use SportExperiment\Model\Eloquent\WillingnessPayEntry;
use Illuminate\Support\Facades\Input;
use SportExperiment\Model\ModelCollection;
use Illuminate\Support\Facades\Redirect;
use SportExperiment\View\Composer\Subject\GameHold as GameHoldComposer;

class Experiment extends BaseController
{
    private static $URI = 'subject/experiment';

    private $subjectRepository;
    private $subject;

    public function __construct(SubjectRepositoryInterface $subjectRepository, Subject $subject)
    {
        $this->subjectRepository = $subjectRepository;
        $this->subject = $subject;
        View::composer(ExperimentComposer::$VIEW_PATH, ExperimentComposer::getNamespace());
        View::composer(GameHoldComposer::$VIEW_PATH, GameHoldComposer::getNamespace());
    }

    public function getExperiment()
    {
        return View::make(ExperimentComposer::$VIEW_PATH);
    }

    public function postExperiment()
    {
        $modelCollection = new ModelCollection();

        $session = $this->subject->getSession();

        if ($session->getWillingnessPayTreatment() != null)
            $modelCollection->addModel(new WillingnessPayEntry(Input::all(), $session->getWillingnessPayTreatment()->getEndowment()));

        if ($session->getRiskAversionTreatment() != null)
            $modelCollection->addModel(new RiskAversionEntry(Input::all()));

        if ($session->getUltimatumTreatment() != null) {
            $ultimatumEntry = new UltimatumEntry(Input::all());
            $ultimatumEntry->setAmountMaxRule($this->subject->getUltimatumTreatment()->getTotalAmount());
            $modelCollection->addModel($ultimatumEntry);
        }

        if ($modelCollection->validationFails())
            return Redirect::to(self::getRoute())->withInput()->with('errors', $modelCollection->getErrorMessages());

        $this->subjectRepository->saveSubjectData(Auth::user()->subject, $modelCollection);
        return View::make(GameHoldComposer::$VIEW_PATH);
    }

    public static function getRoute()
    {
        return self::$URI;
    }
}