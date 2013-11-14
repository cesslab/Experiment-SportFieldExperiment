<?php namespace SportExperiment\Model\Eloquent;

class UltimatumEntry extends BaseEloquent
{
    public static $TABLE_KEY = 'ultimatum_entries';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $AMOUNT_KEY = 'amount';
    public static $SELECTED_FOR_PAYOFF = 'selected_for_payoff';
    public static $PAYOFF_KEY = 'payoff';

    private static $MIN_KEY = 2;
    private static $MAX_KEY = 3;

    protected $rules;
    protected $table;
    protected $fillable;

    public function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;
        $this->rules = [self::$AMOUNT_KEY=>['required', 'numeric', self::$MIN_KEY=>'min:0', self::$MAX_KEY=>'max:1000']];

        $this->fillable = [self::$AMOUNT_KEY];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::getNamespace(), self::$SUBJECT_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * Sets the maximum value allowed for the amount value, enforced during validation.
     * @param int $size
     */
    public function setAmountMaxRule($size)
    {
        $this->rules[self::$AMOUNT_KEY][self::$MAX_KEY] = 'max:' . $size;
    }

    /**
     * @param bool $isSelected
     */
    public function setSelectedForPayoff($isSelected)
    {
        $this->setAttribute(self::$SELECTED_FOR_PAYOFF, $isSelected);
    }
}