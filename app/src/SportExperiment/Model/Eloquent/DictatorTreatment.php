<?php namespace SportExperiment\Model\Eloquent;

use SportExperiment\Model\Group;
use SportExperiment\Model\GroupTreatmentInterface;
use SportExperiment\Model\TreatmentInterface;

class DictatorTreatment extends BaseEloquent implements GroupTreatmentInterface, TreatmentInterface
{
    public static $TABLE_KEY = 'dictator_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $PROPOSER_ENDOWMENT_KEY = 'proposer_endowment';
    public static $TASK_ID_KEY = 'task_id';

    public static $TREATMENT_ENABLED_KEY = 'dictatorEnabled';

    private static $TASK_ID = 5;

    private static $PROPOSER_ROLE_ID = 1;
    private static $RECEIVER_ROLE_ID = 2;

    public $timestamps = false;

    protected $table;
    protected $fillable;
    protected $rules;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;

        $this->fillable = [self::$PROPOSER_ENDOWMENT_KEY];

        $this->rules = [
            self::$PROPOSER_ENDOWMENT_KEY=>['required', 'numeric', 'min:0']];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), self::$SESSION_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Business Logic
     * ---------------------------------------------------------------------*/

    /**
     * @param Subject[] $subjects
     * @return \SportExperiment\Model\Group[]
     */
    public function getGroups($subjects)
    {
        $groups = [];
        // Set Proposers
        foreach ($subjects as $subject) {
            if ($subject->getDictatorGroup()->isProposer()) {
                $groupId = $subject->getDictatorGroup()->getId();
                $group = new Group();
                $group->setSubject($subject, self::$PROPOSER_ROLE_ID);
                $group->setSubject($subject->getDictatorGroup()->getPartner(), self::$RECEIVER_ROLE_ID);
                $groups[$groupId] = $group;
            }
        }
        return $groups;
    }

    /**
     * Calculates and saves the receiver and proposer payoffs.
     *
     * @param Subject $receiver
     * @param Subject $proposer
     */
    public function calculateGroupPayoff(Subject $proposer, Subject $receiver)
    {
        $treatment = $proposer->getDictatorTreatment();
        $dictatorEntry = $proposer->getRandomDictatorEntry();
        $dictatorEntry->setSelectedForPayoff(true);
        $dictatorEntry->setPayoff($treatment->getProposerEndowment() - $dictatorEntry->getDictatorAllocation());

        // Since the receiver's entries don't impact their payoff one entry is selected at random for storing the payoff.
        $receiverEntry = $receiver->getRandomDictatorEntry();
        $receiverEntry->setSelectedForPayoff(true);
        $receiverEntry->setPayoff($dictatorEntry->getDictatorAllocation());

        $dictatorEntry->save();
        $receiverEntry->save();
    }

    /**
     * Calculates the subject's Dictator Payoffs.
     *
     * @param Subject $subject
     */
    public function calculatePayoff(Subject $subject)
    {
        if ($subject->getDictatorGroup()->isProposer()) {
            $proposer = $subject;
            $receiver = $subject->getDictatorGroup()->getPartner();
        }
        else {
            $proposer = $subject->getDictatorGroup()->getPartner();
            $receiver = $subject;
        }

        $treatment = $proposer->getDictatorTreatment();
        $dictatorEntry = $proposer->getRandomDictatorEntry();
        $dictatorEntry->setPayoff($treatment->getProposerEndowment() - $dictatorEntry->getDictatorAllocation());

        // Since the receiver's entries don't impact their payoff one entry is selected at random for storing the payoff.
        $receiverEntry = $receiver->getRandomDictatorEntry();
        $receiverEntry->setPayoff($dictatorEntry->getDictatorAllocation());

        if ($subject->getDictatorGroup()->isProposer()) {
            $dictatorEntry->setSelectedForPayoff(true);
            $dictatorEntry->save();
        }
        else {
            $receiverEntry->save();
            $receiverEntry->setSelectedForPayoff(true);
        }
    }

    /**
     * Saves a group record for each group member.
     *
     * @param $groups \SportExperiment\Model\Group[]
     */
    public function saveGroups($groups)
    {
        foreach ($groups as $group) {
            $proposer = $group->getSubject(self::$PROPOSER_ROLE_ID);
            $receiver = $group->getSubject(self::$RECEIVER_ROLE_ID);

            $proposerGroup = new DictatorGroup();
            $proposerGroup->setSubjectId($proposer->getId());
            $proposerGroup->setSubjectRole(self::$PROPOSER_ROLE_ID);
            $proposerGroup->setPartnerId($receiver->getId());
            $proposerGroup->setPartnerRole(self::$RECEIVER_ROLE_ID);
            $proposerGroup->save();

            $receiverGroup = new DictatorGroup();
            $receiverGroup->setSubjectId($receiver->getId());
            $receiverGroup->setSubjectRole(self::$RECEIVER_ROLE_ID);
            $receiverGroup->setPartnerId($proposer->getId());
            $receiverGroup->setPartnerRole(self::$PROPOSER_ROLE_ID);
            $receiverGroup->save();
        }
    }

    /**
     * Sets and saves group records for each subject.
     *
     * @param \SportExperiment\Model\Eloquent\Subject[] $subjects
     */
    public function setSubjectGroups($subjects)
    {
        foreach ($subjects as $subject) {
            $group = new DictatorGroup();
            $group->setSubjectId($subject->getId());
            $group->setSubjectRole(self::$PROPOSER_ROLE_ID);
            $group->setPartnerId($subject->getId());
            $group->setPartnerRole(self::$PROPOSER_ROLE_ID);
            $group->save();
        }
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @return mixed
     */
    public function getProposerEndowment()
    {
        return $this->getAttribute(self::$PROPOSER_ENDOWMENT_KEY);
    }

    public function getId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    public function setTreatmentTaskId($taskId)
    {
        $this->setAttribute(self::$TASK_ID_KEY, $taskId);
    }

    public function getTreatmentTaskId()
    {
        return $this->getAttribute(self::$TASK_ID_KEY);
    }

    /**
     * @return int
     */
    public static function getProposerRoleId()
    {
        return self::$PROPOSER_ROLE_ID;
    }

    /**
     * @return int
     */
    public static function getReceiverRoleId()
    {
        return self::$RECEIVER_ROLE_ID;
    }

    /**
     * Returns the Task ID.
     *
     * @return int
     */
    public static function getTaskId()
    {
        return self::$TASK_ID;
    }

}