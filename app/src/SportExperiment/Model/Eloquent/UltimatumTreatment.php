<?php namespace SportExperiment\Model\Eloquent;


class UltimatumTreatment extends BaseEloquent
{
    public static $TABLE_KEY = 'ultimatum_treatments';
    private static $TASK_ID = 3;

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $TOTAL_AMOUNT_KEY = 'total_amount';

    public $timestamps = false;

    protected $table;
    protected $fillable;
    protected $rules;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = []){
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
     * @param Subject[] $proposers
     * @param Subject[] $receivers
     */
    public function matchSubjects(array $proposers, array $receivers)
    {
        // There must be at least one of each role to perform matching appropriately
        if (count($receivers) == 0 || count($proposers) == 0)
            return;

        $this->matchProposersReceivers($proposers, $receivers);
    }

    /**
     * @param Subject[] $proposers
     * @param Subject[] $receivers
     */
    private function matchProposersReceivers(array $proposers, array $receivers)
    {
        $totalSubjects = count($proposers) + count($receivers);
        shuffle($proposers);
        shuffle($receivers);
        $i = 0; $j = 0;
        for ($k = 0; $k < $totalSubjects; ++$k) {
            $i = ( ! isset($proposers[$i])) ? 0 : $i;
            $j = ( ! isset($receivers[$j])) ? 0 : $j;
            $this->matchPairMember($proposers[$i], $receivers[$j]);
            ++$i; ++$j;
        }
    }

    /**
     * Matches to Ultimatum subjects of differing roles.
     *
     * @param Subject $proposer
     * @param Subject $receiver
     */
    private function matchPairMember(Subject $proposer,Subject $receiver)
    {
        $proposerRole = $proposer->getUltimatumRole();
        $proposerRole->setPartnerId($receiver->getId());
        $proposerRole->save();

        $receiverRole = $receiver->getUltimatumRole();
        $receiverRole->setPartnerId($proposer->getId());
        $receiverRole->save();
    }

    /**
     * Returns the subject's ultimatum payoff.
     *
     * @param Subject $subject
     * @return UltimatumEntry
     */
    public function calculatePayoff(Subject $subject)
    {
        $opponent = $subject->getUltimatumRole()->getPartner();
        $opponentEntry = $opponent->getRandomUltimatumEntry();

        $playerEntry = $subject->getRandomUltimatumEntry();
        $ultimatumTreatment = $subject->getUltimatumTreatment();
        // Proposer Payoff
        if ($subject->getUltimatumRole()->getRole() == UltimatumRole::getProposerId()) {
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