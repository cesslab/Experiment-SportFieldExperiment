<?php namespace SportExperiment\Model\Eloquent;

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
     * Returns the subject's ultimatum payoff.
     *
     * @param Subject $subject
     * @return UltimatumEntry
     */
    public function calculatePayoff(Subject $subject)
    {
        $opponent = $subject->getUltimatumGroup()->getPartner();
        $opponentEntry = $opponent->getRandomUltimatumEntry();

        $playerEntry = $subject->getRandomUltimatumEntry();
        $ultimatumTreatment = $subject->getUltimatumTreatment();

        // Proposer Payoff
        if ($subject->getUltimatumGroup()->isProposer()) {
            if ($playerEntry->getAmount() >= $opponentEntry->getAmount())
                $playerEntry->setPayoff($ultimatumTreatment->getTotalAmount() - $playerEntry->getAmount());
            else
                $playerEntry->setPayoff(0);
        }
        // Receiver Payoff
        else {
            if ($opponentEntry->getAmount() <= $playerEntry->getAmount())
                $playerEntry->setPayoff($opponentEntry->getAmount());
            else
                $playerEntry->setPayoff(0);
        }

        $playerEntry->setPartnerId($opponent->getId());
        $playerEntry->setPartnerAmount($opponentEntry->getAmount());
        $playerEntry->setPartnerEntryId($opponentEntry->getId());

        return $playerEntry;
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