<?php namespace SportExperiment\Model\Eloquent;

class UltimatumEntry extends TaskEntry
{
    public static $TABLE_KEY = 'ultimatum_entries';

    public static $AMOUNT_KEY = 'amount';

    protected $rules;
    protected $table;
    protected $fillable;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;
        $this->rules = [self::$AMOUNT_KEY=>['required', 'numeric', 'min:0']];

        $this->fillable = [self::$AMOUNT_KEY];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->getAttribute(self::$AMOUNT_KEY);
    }

    /**
     * Sets the maximum value allowed for the amount value, enforced during validation.
     * @param int $size
     */
    public function setMaxAmountRule($size)
    {
        $this->rules[self::$AMOUNT_KEY][] = 'max:' . $size;
    }
}