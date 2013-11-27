<?php namespace SportExperiment\Model\Eloquent;

use SportExperiment\Model\Group;
use SportExperiment\Model\GroupTreatmentInterface;

class UltimatumTreatment extends BaseEloquent implements GroupTreatmentInterface
{
    public static $TABLE_KEY = 'ultimatum_treatments';
    private static $TASK_ID = 3;

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $TOTAL_AMOUNT_KEY = 'total_amount';

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

        $this->fillable = [self::$TOTAL_AMOUNT_KEY];

        $this->rules = [
            self::$TOTAL_AMOUNT_KEY=>'required|numeric|min:0|max:1000000'
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
     * Model Routines
     * ---------------------------------------------------------------------*/

    /**
     * @param $groups \SportExperiment\Model\Group[]
     */
    public function saveGroups($groups)
    {
        foreach ($groups as $group) {
            $proposer = $group->getSubject(self::$PROPOSER_ROLE_ID);
            $receiver = $group->getSubject(self::$RECEIVER_ROLE_ID);

            $proposerGroup = new UltimatumGroup();
            $proposerGroup->setSubjectId($proposer->getId());
            $proposerGroup->setSubjectRole(self::$PROPOSER_ROLE_ID);
            $proposerGroup->setPartnerId($receiver->getId());
            $proposerGroup->setPartnerRole(self::$RECEIVER_ROLE_ID);
            $proposerGroup->save();

            $receiverGroup = new UltimatumGroup();
            $receiverGroup->setSubjectId($receiver->getId());
            $receiverGroup->setSubjectRole(self::$RECEIVER_ROLE_ID);
            $receiverGroup->setPartnerId($proposer->getId());
            $receiverGroup->setPartnerRole(self::$PROPOSER_ROLE_ID);
            $receiverGroup->save();
        }
    }

    /**
     * @param Subject[] $subjects
     * @return \SportExperiment\Model\Group[]
     */
    public function getGroups($subjects)
    {
        $groups = [];
        // Set Proposers
        foreach ($subjects as $subject) {
            if ($subject->getUltimatumGroup()->isProposer()) {
                $groupId = $subject->getUltimatumGroup()->getId();
                $group = new Group();
                $group->setSubject($subject, self::$PROPOSER_ROLE_ID);
                $group->setSubject($subject->getUltimatumGroup()->getPartner(), self::$RECEIVER_ROLE_ID);
                $groups[$groupId] = $group;
            }
        }

        return $groups;
    }

    /**
     * Calculates and saves the proposer and receiver payoffs.
     *
     * @param Subject $proposer
     * @param Subject $receiver
     */
    public function calculateGroupPayoff(Subject $proposer, Subject $receiver)
    {
        $proposerEntry = $proposer->getRandomUltimatumEntry();
        $proposerEntry->setSelectedForPayoff(true);

        $receiverEntry = $receiver->getRandomUltimatumEntry();
        $receiverEntry->setSelectedForPayoff(true);

        // Proposer Payoff
        if ($proposerEntry->getAmount() >= $receiverEntry->getAmount())
            $proposerEntry->setPayoff($this->getTotalAmount() - $proposerEntry->getAmount());
        else
            $receiverEntry->setPayoff(0);

        // Receiver Payoff
        if ($receiverEntry->getAmount() <= $proposerEntry->getAmount())
            $receiverEntry->setPayoff($proposerEntry->getAmount());
        else
            $receiverEntry->setPayoff(0);

        $proposerEntry->save();
        $receiverEntry->save();
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/
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
     * @return mixed
     */
    public function getTotalAmount()
    {
        return $this->getAttribute(self::$TOTAL_AMOUNT_KEY);
    }

    public static function getTaskId()
    {
        return self::$TASK_ID;
    }
}