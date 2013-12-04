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
            $riskAversionEntry = $this->subject->getRiskAversionPayoff();
            if ($riskAversionEntry !== null) {
                $view->with('riskAversionActive', true);
                $view->with('riskAversionTaskId', RiskAversionTreatment::getTaskId());
                $view->with('riskAversionPayoff', number_format($riskAversionEntry->getPayoff(), 2));
            }
            else {
                $view->with('riskAversionActive', false);
            }
        }
        else {
            $view->with('riskAversionActive', false);
        }

        if ($this->subject->getWillingnessPayTreatment() !== null) {
            $willingnessPayEntry = $this->subject->getWillingnessPayPayoff();
            if ($willingnessPayEntry !== null) {
                $view->with('willingnessPayActive', true);
                $view->with('willingnessPayTaskId', WillingnessPayTreatment::getTaskId());
                $view->with('willingnessPayPayoff', number_format($willingnessPayEntry->getPayoff(), 2));
                $view->with('itemPurchased', $willingnessPayEntry->getItemPurchased());
            }
            else {
                $view->with('willingnessPayActive', false);
            }
        }
        else {
            $view->with('willingnessPayActive', false);
        }

        if ($this->subject->getUltimatumTreatment() !== null) {
            $ultimatumEntry = $this->subject->getUltimatumPayoff();
            if ($ultimatumEntry !== null) {
                $view->with('ultimatumActive', true);
                $view->with('ultimatumTaskId', UltimatumTreatment::getTaskId());
                $view->with('ultimatumPayoff', number_format($ultimatumEntry->getPayoff(), 2));
            }
            else {
                $view->with('ultimatumActive', false);
            }
        }
        else {
            $view->with('ultimatumActive', false);
        }

        if ($this->subject->getTrustTreatment() !== null) {
            $trustEntry = $this->subject->getTrustPayoff();
            if ($trustEntry !== null) {
                $view->with('trustActive', true);
                $view->with('trustTaskId', TrustTreatment::getTaskId());
                $view->with('trustPayoff', number_format($trustEntry->getPayoff(), 2));
            }
            else {
                $view->with('trustActive', false);
            }
        }
        else {
            $view->with('trustActive', false);
        }

        if ($this->subject->getDictatorTreatment() !== null) {
            $dictatorEntry = $this->subject->getDictatorPayoff();
            if ($dictatorEntry !== null) {
                $view->with('dictatorActive', true);
                $view->with('dictatorTaskId', DictatorTreatment::getTaskId());
                $view->with('dictatorPayoff', number_format($dictatorEntry->getPayoff(), 2));
            }
            else {
                $view->with('dictatorActive', false);
            }
        }
        else {
            $view->with('dictatorActive', false);
        }

        $view->with('postUrl', URL::to(PayoffController::getRoute()));
    }

}