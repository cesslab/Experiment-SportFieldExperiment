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
        if (count($receivers) == 0 || count($proposers) == 0) {
            return;
        }

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
            // Two pairs found
            if (isset($proposers[$i]) && isset($receivers[$j])) {
                $i = ( ! isset($proposers[$i])) ? 0 : $i;
                $j = ( ! isset($proposers[$j])) ? 0 : $j;
                $this->matchPairMember($proposers[$i], $receivers[$j]);
                ++$i; ++$j;
            }
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
     * @param Subject $subject
     * @return UltimatumEntry
     */
    public function calculatePayoff(Subject $subject)
    {
        $entry = $subject->getRandomUltimatumEntry();

        // get a random
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