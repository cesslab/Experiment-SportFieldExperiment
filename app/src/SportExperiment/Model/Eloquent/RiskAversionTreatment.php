<?php namespace SportExperiment\Model\Eloquent;

class RiskAversionTreatment extends BaseEloquent
{
    public static $TABLE_KEY = 'risk_aversion_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $LOW_PRIZE_KEY = 'low_prize';
    public static $MID_PRIZE_KEY = 'mid_prize';
    public static $HIGH_PRIZE_KEY = 'high_prize';
    public static $GAMBLE_PROBABILITY_KEY = 'gamble_probability';

    public static $TREATMENT_ENABLED_KEY = 'riskAversionEnabled';

    private static $TASK_ID = 1;

    public $timestamps = false;

    protected $table;
    protected $fillable;
    protected $rules;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = []){
        $this->table = self::$TABLE_KEY;

        $this->fillable = [
            self::$SESSION_ID_KEY, self::$LOW_PRIZE_KEY, self::$MID_PRIZE_KEY,
            self::$HIGH_PRIZE_KEY, self::$GAMBLE_PROBABILITY_KEY];

        $this->rules = [
            self::$LOW_PRIZE_KEY=>'required|numeric|min:0|max:1000000',
            self::$MID_PRIZE_KEY=>'required|numeric|min:0|max:1000000',
            self::$HIGH_PRIZE_KEY=>'required|numeric|min:0|max:1000000',
            self::$GAMBLE_PROBABILITY_KEY=>'required|numeric|min:0|max:1'
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
     * @param Subject $subject
     * @return RiskAversionEntry
     */
    public function calculatePayoff(Subject $subject)
    {
        $entry = $subject->getRandomRiskAversionEntry();
        $prizeDraw = lcg_value();
        if ($prizeDraw < $entry->getIndifferenceProbability()) {
            $entry->setPayoff($this->getMidPrize());
            return $entry;
        }

        $gambleDraw = lcg_value();
        if ($gambleDraw < $entry->getIndifferenceProbability()) {
            $entry->setPayoff($this->getHighPrize());
            return $entry;
        }

        $entry->setPayoff($this->getLowPrize());
        return $entry;
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

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
     * @return mixed
     */
    public function getHighPrize()
    {
        return $this->getAttribute(self::$HIGH_PRIZE_KEY);
    }

    /**
     * @return mixed
     */
    public function getLowPrize()
    {
        return $this->getAttribute(self::$LOW_PRIZE_KEY);
    }

    /**
     * @return mixed
     */
    public function getMidPrize()
    {
        return $this->getAttribute(self::$MID_PRIZE_KEY);
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->getAttribute(self::$SESSION_ID_KEY);
    }

    /**
     * @return mixed
     */
    public function getGambleProbability()
    {
        return $this->getAttribute(self::$GAMBLE_PROBABILITY_KEY);
    }

    /**
     * @param $gambleProbability
     */
    public function setGambleProbability($gambleProbability)
    {
        $this->setAttribute(self::$GAMBLE_PROBABILITY_KEY, $gambleProbability);

    }
}