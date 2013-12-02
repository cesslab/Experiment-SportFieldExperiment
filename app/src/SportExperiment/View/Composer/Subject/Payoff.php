<?php namespace SportExperiment\View\Composer\Subject;

use Illuminate\Support\Facades\URL;
use SportExperiment\Model\Eloquent\DictatorTreatment;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\TrustTreatment;
use SportExperiment\Model\Eloquent\UltimatumTreatment;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
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

        if ($this->subject->getRiskAversionTreatment() !== null) {
            $view->with('riskAversionActive', true);
            $riskAversionEntry = $this->subject->getRiskAversionPayoff();
            $view->with('riskAversionTaskId', RiskAversionTreatment::getTaskId());
            $view->with('riskAversionPayoff', $riskAversionEntry->getPayoff());
        }
        else {
            $view->with('riskAversionActive', false);
        }

        if ($this->subject->getWillingnessPayTreatment() !== null) {
            $view->with('willingnessPayActive', true);
            $willingnessPayEntry = $this->subject->getWillingnessPayPayoff();
            $view->with('willingnessPayTaskId', WillingnessPayTreatment::getTaskId());
            $view->with('willingnessPayPayoff', $willingnessPayEntry->getPayoff());
            $view->with('itemPurchased', $willingnessPayEntry->getItemPurchased());
        }
        else {
            $view->with('willingnessPayActive', false);
        }

        if ($this->subject->getUltimatumTreatment() !== null) {
            $view->with('ultimatumActive', true);
            $ultimatumEntry = $this->subject->getUltimatumPayoff();
            $view->with('ultimatumTaskId', UltimatumTreatment::getTaskId());
            $view->with('ultimatumPayoff', $ultimatumEntry->getPayoff());
        }
        else {
            $view->with('ultimatumActive', false);
        }

        if ($this->subject->getTrustTreatment() !== null) {
            $view->with('trustActive', true);
            $trustEntry = $this->subject->getTrustPayoff();
            $view->with('trustTaskId', TrustTreatment::getTaskId());
            $view->with('trustPayoff', $trustEntry->getPayoff());
        }
        else {
            $view->with('trustActive', false);
        }

        if ($this->subject->getDictatorTreatment() !== null) {
            $view->with('dictatorActive', true);
            $dictatorEntry = $this->subject->getDictatorPayoff();
            $view->with('dictatorTaskId', DictatorTreatment::getTaskId());
            $view->with('dictatorPayoff', $dictatorEntry->getPayoff());
        }
        else {
            $view->with('dictatorActive', false);
        }

        $view->with('postUrl', URL::to(PayoffController::getRoute()));
    }

}