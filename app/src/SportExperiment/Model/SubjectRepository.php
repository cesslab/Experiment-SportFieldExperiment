<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\DictatorEntry;
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
     * @return null
     */
    public function saveSubjectData(Subject $subject, ModelCollection $collection)
    {
        if ($subject->getWillingnessPayTreatment() != null)
            $this->saveEntry($collection->getModel(WillingnessPayEntry::getNamespace()), $subject);

        if ($subject->getRiskAversionTreatment() != null)
            $this->saveEntry($collection->getModel(RiskAversionEntry::getNamespace()), $subject);

        if ($subject->getUltimatumTreatment() != null) {
            $this->saveEntry($collection->getModel(UltimatumEntry::getNamespace()), $subject);
        }

        if ($subject->getTrustTreatment() != null) {
            $trustEntry = new TrustEntry();
            $this->saveEntry($trustEntry, $subject);

            if ($subject->getTrustGroup()->isProposer())
               $this->saveTrustProposerEntry($collection->getModel(TrustProposerEntry::getNamespace()), $trustEntry);
            else
                $this->saveTrustReceiverEntries($collection->getModel(TrustReceiverEntry::getNamespace()), $trustEntry);
        }

        if ($subject->getDictatorTreatment() != null) {
            $this->saveEntry($collection->getModel(DictatorEntry::getNamespace()), $subject);
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