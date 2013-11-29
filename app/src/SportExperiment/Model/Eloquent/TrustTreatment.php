<?php namespace SportExperiment\Model\Eloquent;

use SportExperiment\Model\Group;
use SportExperiment\Model\GroupTreatmentInterface;

class TrustTreatment extends BaseEloquent implements GroupTreatmentInterface
{
    public static $TABLE_KEY = 'trust_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $PROPOSER_ALLOCATION_MULTIPLIER_KEY = 'sender_multiplier';
    public static $RECEIVER_ALLOCATION_MULTIPLIER_KEY = 'receiver_multiplier';

    private static $TASK_ID = 4;

    private static $NUM_PROPOSER_ALLOCATIONS = 5;
    private static $NUM_RECEIVER_ALLOCATIONS = 4;

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

        $this->fillable = [self::$PROPOSER_ALLOCATION_MULTIPLIER_KEY, self::$RECEIVER_ALLOCATION_MULTIPLIER_KEY];

        $this->rules = [
            self::$PROPOSER_ALLOCATION_MULTIPLIER_KEY=>'required|numeric|min:0|max:1000000',
            self::$RECEIVER_ALLOCATION_MULTIPLIER_KEY=>'required|numeric|min:0|max:1000000'
        ];

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
            if ($subject->getTrustGroup()->isProposer()) {
                $groupId = $subject->getTrustGroup()->getId();
                $group = new Group();
                $group->setSubject($subject, self::$PROPOSER_ROLE_ID);
                $group->setSubject($subject->getTrustGroup()->getPartner(), self::$RECEIVER_ROLE_ID);
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
        $proposerEntry = $proposer->getRandomTrustEntry();
        $proposerEntry->setSelectedForPayoff(true);

        $proposerAllocationEntry = $proposerEntry->getProposerEntry();
        $proposerAllocation = $proposerAllocationEntry->getAllocation();

        $receiverEntry = $receiver->getRandomTrustEntry();
        $receiverEntry->setSelectedForPayoff(true);

        $trustTreatment = $proposer->getTrustTreatment();

        $receiverAllocationEntry = $receiverEntry->getReceiverAllocationEntry($proposerAllocationEntry, $trustTreatment);
        $receiverAllocation = $receiverAllocationEntry->getAllocation();

        $proposerEntry->setPayoff($this->getProposerEndowment() - $proposerAllocation + $receiverAllocation);
        $receiverEntry->setPayoff($proposerAllocation - $receiverAllocation);

        $proposerEntry->save();
        $receiverEntry->save();
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

            $proposerGroup = new TrustGroup();
            $proposerGroup->setSubjectId($proposer->getId());
            $proposerGroup->setSubjectRole(self::$PROPOSER_ROLE_ID);
            $proposerGroup->setPartnerId($receiver->getId());
            $proposerGroup->setPartnerRole(self::$RECEIVER_ROLE_ID);
            $proposerGroup->save();

            $receiverGroup = new TrustGroup();
            $receiverGroup->setSubjectId($receiver->getId());
            $receiverGroup->setSubjectRole(self::$RECEIVER_ROLE_ID);
            $receiverGroup->setPartnerId($proposer->getId());
            $receiverGroup->setPartnerRole(self::$PROPOSER_ROLE_ID);
            $receiverGroup->save();
        }
    }

    /**
     * Returns sender Allocation values.
     *
     * @return array
     */
    public function getProposerAllocationOptions()
    {
        $multiplier = $this->getProposerAllocationMultiplier();

        $values = [];
        for ($i = 0; $i < self::$NUM_PROPOSER_ALLOCATIONS; ++$i) {
            $values[] = $multiplier * $i;
        }

        return $values;
    }

    /**
     * Returns receiver contribution values.
     *
     * @return array
     */
    public function getReceiverAllocationOptions()
    {
        $senderMultiplier = $this->getProposerAllocationMultiplier();
        $receiverMultiplier = $this->getReceiverAllocationMultiplier();

        $values = [];
        for ($i = 1; $i <= self::$NUM_RECEIVER_ALLOCATIONS; ++$i) {
            $values[] = $receiverMultiplier * $senderMultiplier * $i;
        }

        return $values;
    }

    public function getProposerEndowment()
    {
        $allocationOptions = $this->getProposerAllocationOptions();
        return $allocationOptions[self::$NUM_PROPOSER_ALLOCATIONS-1];
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/
    /**
     * @return int
     */
    public static function getNumProposerAllocations()
    {
        return self::$NUM_PROPOSER_ALLOCATIONS;
    }

    /**
     * @return int
     */
    public static function getNumReceiverAllocations()
    {
        return self::$NUM_RECEIVER_ALLOCATIONS;
    }

    /**
     * @return mixed
     */
    public function getProposerAllocationMultiplier()
    {
        return $this->getAttribute(self::$PROPOSER_ALLOCATION_MULTIPLIER_KEY);
    }

    /**
     * @return mixed
     */
    public function getReceiverAllocationMultiplier()
    {
        return $this->getAttribute(self::$RECEIVER_ALLOCATION_MULTIPLIER_KEY);
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

} 