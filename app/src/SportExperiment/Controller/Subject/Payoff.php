<?php namespace SportExperiment\Controller\Subject;

use SportExperiment\Controller\BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;
use SportExperiment\Repository\Eloquent\Treatment\RiskAversion;
use SportExperiment\View\Composer\Subject\Payoff as PayoffComposer;

class Payoff extends BaseController
{
    public static $URI = 'subject/experiment/payoff';

    public function getPayoff()
    {
        $payoff = 0;

        /* @var $subject \SportExperiment\Repository\Eloquent\Subject */
        $subject = Auth::user()->subject;
        if ( ! is_null($subject->getPayoff()))
            return View::make(PayoffComposer::$VIEW_PATH);

        /* @var $session \SportExperiment\Repository\Eloquent\Session */
        $session = $subject->session;
        // Calculate Risk Aversion Payoff
        if ($session->riskAversion !== null) {
            $riskAversion = new RiskAversion();
            $payoff = $riskAversion->calculatePayoff($subject);
            var_dump($payoff);
        }

        // Calculate Willingness to Pay Payoff
        if ($session->willingnessPay !== null) {
            $willingnessPay = new WillingnessPay();
            $payoff = $willingnessPay->calculatePayoff($subject);
            var_dump($payoff);
        }

        die();
        $subject->setPayoff($payoff);
        $subject->save();
        return View::make(PayoffComposer::$VIEW_PATH);
    }

    public static function getRoute()
    {
        return self::$URI;
    }

} 