<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\Charity;
use SportExperiment\Model\Eloquent\DictatorEntry;
use SportExperiment\Model\Eloquent\Good;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\TaskEntry;
use SportExperiment\Model\Eloquent\TrustProposerEntry;
use SportExperiment\Model\Eloquent\TrustEntry;
use SportExperiment\Model\Eloquent\TrustReceiverEntry;
use SportExperiment\Model\Eloquent\UltimatumEntry;
use SportExperiment\Model\Eloquent\WillingnessPayEntry;
use SportExperiment\Model\Eloquent\RiskAversionEntry;

/**
 * Class SubjectRepository
 * @package SportExperiment\Model
 */
class SubjectRepository implements SubjectRepositoryInterface
{
    /**
     * @param Subject $subject
     * @param ModelCollection $collection
     * @param $nextTreatment
     * @return null
     */
    public function saveSubjectData(Subject $subject, ModelCollection $collection, $nextTreatment)
    {
        if ($subject->getWillingnessPayTreatment() instanceof $nextTreatment)
            $this->saveEntry($collection->getModel(WillingnessPayEntry::getNamespace()), $subject);

        if ($subject->getRiskAversionTreatment() instanceof $nextTreatment)
            $this->saveEntry($collection->getModel(RiskAversionEntry::getNamespace()), $subject);

        if ($subject->getUltimatumTreatment() instanceof $nextTreatment) {
            $this->saveEntry($collection->getModel(UltimatumEntry::getNamespace()), $subject);
        }

        if ($subject->getTrustTreatment() instanceof $nextTreatment) {
            $trustEntry = new TrustEntry();
            $this->saveEntry($trustEntry, $subject);

            if ($subject->getTrustGroup()->isProposer())
               $this->saveTrustProposerEntry($collection->getModel(TrustProposerEntry::getNamespace()), $trustEntry);
            else
                $this->saveTrustReceiverEntries($collection->getModel(TrustReceiverEntry::getNamespace()), $trustEntry);
        }

        if ($subject->getDictatorTreatment() instanceof $nextTreatment) {
            $this->saveEntry($collection->getModel(DictatorEntry::getNamespace()), $subject);
        }

        // Save Charity Selection
        $charity = $collection->getModel(Charity::getNamespace());
        if ($charity != null) {
            $charity->subject()->associate($subject);
            $charity->save();
        }

        // Save Good Selection
        $good = $collection->getModel(Good::getNamespace());
        if ($good != null) {
            $good->subject()->associate($subject);
            $good->save();
        }
    }

    /**
     * @param TrustProposerEntry $proposerEntry
     * @param TrustEntry $trustEntry
     */
    public function saveTrustProposerEntry(TrustProposerEntry $proposerEntry, TrustEntry $trustEntry)
    {
        $proposerEntry->trustEntry()->associate($trustEntry);
        $proposerEntry->save();
    }

    /**
     * @param TrustReceiverEntry $receiverEntry
     * @param TrustEntry $trustEntry
     */
    public function saveTrustReceiverEntries(TrustReceiverEntry $receiverEntry, TrustEntry $trustEntry)
    {
        $allocations = $receiverEntry->getAllocation();
        foreach($allocations as $proposerAllocation=>$receiverAllocation) {
            $receiverEntry = new TrustReceiverEntry();
            $receiverEntry->setAllocation($receiverAllocation);
            $receiverEntry->setProposerAllocation($proposerAllocation);
            $receiverEntry->trustEntry()->associate($trustEntry);
            $receiverEntry->save();
        }
    }

    /**
     * @param TaskEntry $entry
     * @param Subject $subject
     */
    public function saveEntry(TaskEntry $entry, Subject $subject)
    {
        $entry->subject()->associate($subject);
        $entry->save();
    }
}