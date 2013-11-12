<?php namespace SportExperiment\Controller\Subject;

use Illuminate\Support\Facades\Redirect;
use SportExperiment\Controller\BaseController;
use Illuminate\Support\Facades\View;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\SubjectState;
use SportExperiment\View\Composer\Subject\Payoff as PayoffComposer;

class Payoff extends BaseController
{
    public static $URI = 'subject/experiment/payoff';

    private $subject;

    function __construct(Subject $subject)
    {
        $this->subject = $subject;
        View::composer(PayoffComposer::$VIEW_PATH, PayoffComposer::getNamespace());
    }


    public function getPayoff()
    {
        if ( ! $this->subject->isPayoffSet())
            $this->subject->saveCalculatedPayoffs();

        return View::make(PayoffComposer::$VIEW_PATH);
    }

    public function postPayoff()
    {
        if ($this->subject->getState() === SubjectState::$PAYOFF) {
            $this->subject->setState(SubjectState::$OUTGOING_QUESTIONNAIRE);
            $this->subject->save();
        }

        return Redirect::to(Questionnaire::getRoute());
    }

    public static function getRoute()
    {
        return self::$URI;
    }

} 