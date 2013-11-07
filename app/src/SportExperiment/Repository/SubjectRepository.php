<?php namespace SportExperiment\Repository;

use SportExperiment\Repository\Eloquent\Subject;
use SportExperiment\Repository\Eloquent\Subject\WillingnessPay;
use SportExperiment\Repository\Eloquent\Subject\RiskAversion;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function saveSubjectData(Subject $subject, ModelCollection $collection)
    {
        /* @var $willingnessPay \SportExperiment\Repository\Eloquent\Subject\WillingnessPay */
        $willingnessPay = $collection->getModel(WillingnessPay::getNamespace());
        if ($willingnessPay != null) {
            $willingnessPay->subject()->associate($subject);
            $willingnessPay->save();
        }

        /* @var $riskAversion \SportExperiment\Repository\Eloquent\Subject\WillingnessPay */
        $riskAversion = $collection->getModel(RiskAversion::getNamespace());
        if ($riskAversion != null) {
            $riskAversion->subject()->associate($subject);
            $riskAversion->save();
        }
    }
}