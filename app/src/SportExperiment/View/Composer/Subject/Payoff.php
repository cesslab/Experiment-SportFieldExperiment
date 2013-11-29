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
        $riskAversionEntry = $this->subject->getRiskAversionPayoff();
        $willingnessPayEntry = $this->subject->getWillingnessPayPayoff();
        $ultimatumEntry = $this->subject->getUltimatumPayoff();
        $trustEntry = $this->subject->getTrustPayoff();
        $dictatorEntry = $this->subject->getDictatorPayoff();

        $view->with('riskAversionTaskId', RiskAversionTreatment::getTaskId());
        $view->with('riskAversionPayoff', $riskAversionEntry->getPayoff());

        $view->with('willingnessPayTaskId', WillingnessPayTreatment::getTaskId());
        $view->with('willingnessPayPayoff', $willingnessPayEntry->getPayoff());
        $view->with('itemPurchased', $willingnessPayEntry->getItemPurchased());

        $view->with('ultimatumTaskId', UltimatumTreatment::getTaskId());
        $view->with('ultimatumPayoff', $ultimatumEntry->getPayoff());

        $view->with('ultimatumTaskId', UltimatumTreatment::getTaskId());
        $view->with('ultimatumPayoff', $ultimatumEntry->getPayoff());

        $view->with('trustTaskId', TrustTreatment::getTaskId());
        $view->with('trustPayoff', $trustEntry->getPayoff());

        $view->with('dictatorTaskId', DictatorTreatment::getTaskId());
        $view->with('dictatorPayoff', $dictatorEntry->getPayoff());

        $view->with('postUrl', URL::to(PayoffController::getRoute()));
    }

}