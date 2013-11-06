<?php namespace SportExperiment\Controller\Subject;

use Illuminate\Support\Facades\Auth;
use SportExperiment\Controller\BaseController;
use SportExperiment\Repository\Eloquent\Treatment\WillingnessPay;

class Experiment extends BaseController
{
    public static $URI = 'subject/experiment';

    public function getExperiment()
    {
        $subject = Auth::user()->subject;
        /* @var $willingnessPay \SportExperiment\Repository\Eloquent\Treatment\WillingnessPay */
        $willingnessPay = $subject->session->willingnessPay;

        $riskAversion = $subject->session->riskAversion;
        var_dump($riskAversion);
    }
}