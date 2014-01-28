<?php namespace SportExperiment\Model\Eloquent;

use SportExperiment\Model\TreatmentInterface;

class RiskAversionTreatment extends BaseEloquent implements TreatmentInterface
{
    private static $TASK_ID = 3;

    public static $TABLE_KEY = 'risk_aversion_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $ENDOWMENT_KEY = 'endowment';
    public static $LOW_PRIZE_KEY = 'low_prize';
    public static $HIGH_PRIZE_KEY = 'high_prize';
    public static $PRIZE_PROBABILITY_KEY = 'prize_probability';
    public static $TASK_ID_KEY = 'task_id';

    public static $TREATMENT_ENABLED_KEY = 'riskAversionEnabled';

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
            self::$SESSION_ID_KEY, self::$LOW_PRIZE_KEY, self::$PRIZE_PROBABILITY_KEY,
            self::$HIGH_PRIZE_KEY, self::$ENDOWMENT_KEY];

        $this->rules = [
            self::$ENDOWMENT_KEY=>'required|numeric|min:0|max:1000000',
            self::$LOW_PRIZE_KEY=>'required|numeric|min:0|max:1000000',
            self::$HIGH_PRIZE_KEY=>'required|numeric|min:0|max:1000000',
            self::$PRIZE_PROBABILITY_KEY=>'required|numeric|min:0|max:1',
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
     * Calculates and saves the specified subjects Risk Aversion Payoff.
     *
     * @param Subject $subject
     */
    public function calculatePayoff(Subject $subject)
    {
        $entry = $subject->getRandomRiskAversionEntry();

        $prizeDraw = lcg_value()*$this->getEndowment();
        if ($prizeDraw > $entry->getGamblePayment()) {
            $payoff = $this->getEndowment();
        }
        else {
            $gambleDraw = lcg_value();
            if ($gambleDraw <= $this->getPrizeProbability()) {
                $payoff = $this->getEndowment() - $prizeDraw + $this->getHighPrize();
            }
            else {
                $payoff = $this->getEndowment() - $prizeDraw + $this->getLowPrize();
            }
        }

        $entry->setPayoff($payoff);
        $entry->setSelectedForPayoff(true);
        $entry->save();

        $subject->setPayoffTaskId($this->getTreatmentTaskId());
        $subject->setPayoff($entry->getPayoff());
        $subject->save();
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
    public function getId()
    {
        return $this->getAttribute(self::$ID_KEY);
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
    public function getPrizeProbability()
    {
        return $this->getAttribute(self::$PRIZE_PROBABILITY_KEY);
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
    public function getEndowment()
    {
        return $this->getAttribute(self::$ENDOWMENT_KEY);
    }

    /**
     * @return mixed
     */
    public function getTreatmentTaskId()
    {
        return $this->getAttribute(self::$TASK_ID_KEY);
    }

    /**
     * @param $taskId
     */
    public function setTreatmentTaskId($taskId)
    {
        $this->setAttribute(self::$TASK_ID_KEY, $taskId);
    }


}