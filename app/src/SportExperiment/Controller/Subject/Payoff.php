<?php namespace SportExperiment\Controller\Subject;

use SportExperiment\Controller\BaseController;
use Illuminate\Support\Facades\View;
use SportExperiment\Repository\Eloquent\Subject;
use SportExperiment\View\Composer\Subject\Payoff as PayoffComposer;

class Payoff extends BaseController
{
    public static $URI = 'subject/experiment/payoff';

    private $subject;

    function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }


    public function getPayoff()
    {
        if ( ! $this->subject->isPayoffSet())
            $this->subject->saveCalculatedPayoffs();

        return View::make(PayoffComposer::$VIEW_PATH);
    }

    public static function getRoute()
    {
        return self::$URI;
    }

} 