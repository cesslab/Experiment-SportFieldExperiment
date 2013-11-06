<?php namespace SportExperiment\Controller\Subject;

use SportExperiment\Controller\BaseController;
use SportExperiment\Repository\SubjectRepositoryInterface;
use SportExperiment\View\Composer\Subject\Registration as DemographicComposer;
use \Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

        $subject->save();
        return Redirect::to(self::$URI);
    }
}
