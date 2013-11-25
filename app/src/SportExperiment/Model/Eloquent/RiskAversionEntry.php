<?php namespace SportExperiment\Model\Eloquent;

class RiskAversionEntry extends TaskEntry
{
    public static $TABLE_KEY = 'risk_aversion_entries';

    public static $INDIFFERENCE_PROBABILITY_KEY = 'indifference_probability';

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
            self::$INDIFFERENCE_PROBABILITY_KEY=>'required|numeric|min:0|max:1',
        ];

        $this->fillable = [self::$INDIFFERENCE_PROBABILITY_KEY];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @return mixed
     */
    public function getIndifferenceProbability()
    {
        return $this->getAttribute(self::$INDIFFERENCE_PROBABILITY_KEY);
    }
}