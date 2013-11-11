<?php namespace SportExperiment\Repository;

use SportExperiment\Repository\Eloquent\Subject;
use SportExperiment\Repository\Eloquent\WillingnessPayEntry;
use SportExperiment\Repository\Eloquent\RiskAversionEntry;

class SubjectRepository implements SubjectRepositoryInterface
{
    /**
     * @param Subject $subject
     * @param ModelCollection $collection
     * @return null
     */
    public function saveSubjectData(Subject $subject, ModelCollection $collection)
    {
        /* @var $willingnessPay \SportExperiment\Repository\Eloquent\WillingnessPayEntry */
        $willingnessPay = $collection->getModel(WillingnessPayEntry::getNamespace());
        if ($willingnessPay != null) {
            $willingnessPay->subject()->associate($subject);
            $willingnessPay->save();
        }

        /* @var $riskAversion \SportExperiment\Repository\Eloquent\WillingnessPayEntry */
        $riskAversion = $collection->getModel(RiskAversionEntry::getNamespace());
        if ($riskAversion != null) {
            $riskAversion->subject()->associate($subject);
            $riskAversion->save();
        }
    }
}