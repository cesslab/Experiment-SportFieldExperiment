<?php namespace SportExperiment\Model\Eloquent;

class RiskAversionEntry extends TaskEntry
{
    public static $TABLE_KEY = 'risk_aversion_entries';

    public static $GAMBLE_PAYMENT_KEY = 'gamble_payment';

    protected $rules;
    protected $table;
    protected $fillable;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;
        $this->rules = [
            self::$GAMBLE_PAYMENT_KEY=>['required', 'numeric', 'min:0'],
        ];

        $this->fillable = [self::$GAMBLE_PAYMENT_KEY];

        parent::__construct($attributes);
    }

    /**
     * @param $min
     */
    public function setMinGamblePayment($min)
    {
        $this->rules[self::$GAMBLE_PAYMENT_KEY][] = 'min:' . $min;
    }

    /**
     * @param $max
     */
    public function setMaxGamblePayment($max)
    {
        $this->rules[self::$GAMBLE_PAYMENT_KEY][] = 'max:' . $max;
    }


    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @return mixed
     */
    public function getGamblePayment()
    {
        return $this->getAttribute(self::$GAMBLE_PAYMENT_KEY);
    }
}