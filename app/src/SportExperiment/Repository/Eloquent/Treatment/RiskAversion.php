<?php namespace SportExperiment\Repository\Eloquent\Treatment;

use SportExperiment\Repository\Eloquent\Session;
use SportExperiment\Repository\Eloquent\BaseEloquent;

class RiskAversion extends BaseEloquent
{
    public static $TABLE_KEY = 'risk_aversion_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $LOW_PRIZE_KEY = 'low_prize';
    public static $MID_PRIZE_KEY = 'mid_prize';
    public static $HIGH_PRIZE_KEY = 'high_prize';
    public static $GAMBLE_PROBABILITY_KEY = 'gamble_probability';

    public $timestamps = false;

    protected $table;
    protected $fillable;
    protected $rules;

    public function __construct($attributes = array()){
        $this->table = self::$TABLE_KEY;

        $this->fillable = array(
            self::$SESSION_ID_KEY, self::$LOW_PRIZE_KEY, self::$MID_PRIZE_KEY,
            self::$HIGH_PRIZE_KEY, self::$GAMBLE_PROBABILITY_KEY);

        $this->rules = array(
            self::$LOW_PRIZE_KEY=>'required|numeric|min:0|max:1000000',
            self::$MID_PRIZE_KEY=>'required|numeric|min:0|max:1000000',
            self::$HIGH_PRIZE_KEY=>'required|numeric|min:0|max:1000000',
            self::$GAMBLE_PROBABILITY_KEY=>'required|numeric|min:0|max:1'
        );

        parent::__construct($attributes);
    }

    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), self::$SESSION_ID_KEY);
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

    public function getGambleProbability()
    {
        return $this->getAttribute(self::$GAMBLE_PROBABILITY_KEY);
    }

    public function setGambleProbability($gambleProbability)
    {
        $this->setAttribute(self::$GAMBLE_PROBABILITY_KEY, $gambleProbability);

    }
}