<?php namespace SportExperiment\View\Composer\Subject;

use Illuminate\Support\Facades\URL;
use SportExperiment\Repository\Eloquent\Subject;
use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Subject\Payoff as PayoffController;

class Payoff extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.experiment.payoff';
    private $subject;


    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function compose($view)
    {
        $riskAversionEntry = $this->subject->getRiskAversionPayoff();
        $willingnessPayEntry = $this->subject->getWillingnessPayPayoff();
        $view->with('riskAversionPayoff', $riskAversionEntry->getPayoff());
        $view->with('willingnessPayPayoff', $willingnessPayEntry->getPayoff());
        $view->with('itemPurchased', $willingnessPayEntry->getItemPurchased());
        $view->with('totalPayoff', $riskAversionEntry->getPayoff()+$willingnessPayEntry->getPayoff());
        $view->with('postUrl', URL::to(PayoffController::getRoute()));
    }

}