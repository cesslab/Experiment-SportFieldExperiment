<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\WillingnessPayEntry;
use SportExperiment\Model\Eloquent\RiskAversionEntry;

class SubjectRepository implements SubjectRepositoryInterface
{
    /**
     * @param Subject $subject
     * @param ModelCollection $collection
     * @return null
     */
    public function saveSubjectData(Subject $subject, ModelCollection $collection)
    {
        /* @var $willingnessPay \SportExperiment\Model\Eloquent\WillingnessPayEntry */
        $willingnessPay = $collection->getModel(WillingnessPayEntry::getNamespace());
        if ($willingnessPay != null) {
            $willingnessPay->subject()->associate($subject);
            $willingnessPay->save();
        }

        /* @var $riskAversion \SportExperiment\Model\Eloquent\WillingnessPayEntry */
        $riskAversion = $collection->getModel(RiskAversionEntry::getNamespace());
        if ($riskAversion != null) {
            $riskAversion->subject()->associate($subject);
            $riskAversion->save();
        }
    }
}