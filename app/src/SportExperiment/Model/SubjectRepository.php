<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\UltimatumEntry;
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
        /* @var $willingnessPayEntry \SportExperiment\Model\Eloquent\WillingnessPayEntry */
        $willingnessPayEntry = $collection->getModel(WillingnessPayEntry::getNamespace());
        if ($willingnessPayEntry != null) {
            $willingnessPayEntry->subject()->associate($subject);
            $willingnessPayEntry->save();
        }

        /* @var $riskAversionEntry \SportExperiment\Model\Eloquent\WillingnessPayEntry */
        $riskAversionEntry = $collection->getModel(RiskAversionEntry::getNamespace());
        if ($riskAversionEntry != null) {
            $riskAversionEntry->subject()->associate($subject);
            $riskAversionEntry->save();
        }

        /* @var $ultimatumEntry \SportExperiment\Model\Eloquent\UltimatumEntry */
        $ultimatumEntry = $collection->getModel(UltimatumEntry::getNamespace());
        if ($ultimatumEntry != null) {
            $ultimatumEntry->subject()->associate($subject);
            $ultimatumEntry->save();
        }
    }
}