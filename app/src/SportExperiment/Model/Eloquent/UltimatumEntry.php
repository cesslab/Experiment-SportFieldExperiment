<?php namespace SportExperiment\Model\Eloquent;

class UltimatumEntry extends BaseEloquent
{
    public static $TABLE_KEY = 'ultimatum_entries';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $AMOUNT_KEY = 'amount';
    public static $PARTNER_ID_KEY = 'partner_id';
    public static $PARTNER_ENTRY_KEY = 'partner_entry_id';
    public static $PARTNER_AMOUNT_KEY = 'partner_amount';
    public static $SELECTED_FOR_PAYOFF = 'selected_for_payoff';
    public static $PAYOFF_KEY = 'payoff';

    private static $MIN_KEY = 2;
    private static $MAX_KEY = 3;

    protected $rules;
    protected $table;
    protected $fillable;

    /**
     * @param array $attributes
     */
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
     * @return mixed
     */
    public function getId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    /**
     * @return mixed
     */
    public function getPayoff()
    {
        return $this->getAttribute(self::$PAYOFF_KEY);
    }

    /**
     * @return mixed
     */
    public function getPartnerId()
    {
        return $this->getAttribute(self::$PARTNER_ID_KEY);
    }

    /**
     * @return mixed
     */
    public function getPartnerEntryId()
    {
        return $this->getAttribute(self::$PARTNER_ENTRY_KEY);
    }

    /**
     * @return mixed
     */
    public function getPartnerAmount()
    {
        return $this->getAttribute(self::$PARTNER_AMOUNT_KEY);
    }

    /**
     * @return mixed
     */
    public function getSelectedForPayoff()
    {
        return $this->getAttribute(self::$SELECTED_FOR_PAYOFF);
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->getAttribute(self::$AMOUNT_KEY);
    }

    /**
     * @param $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->setAttribute(self::$PARTNER_ID_KEY, $partnerId);
    }

    /**
     * @param $amount
     */
    public function setPartnerAmount($amount)
    {
        $this->setAttribute(self::$PARTNER_AMOUNT_KEY, $amount);
    }

    /**
     * @param $partnerEntryId
     */
    public function setPartnerEntryId($partnerEntryId)
    {
        $this->setAttribute(self::$PARTNER_ENTRY_KEY, $partnerEntryId);
    }

    /**
     * @param $payoff
     */
    public function setPayoff($payoff)
    {
        $this->setAttribute(self::$PAYOFF_KEY, $payoff);
    }

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