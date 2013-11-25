<?php namespace SportExperiment\Model\Eloquent;

class UltimatumEntry extends TaskEntry
{
    public static $TABLE_KEY = 'ultimatum_entries';

    public static $AMOUNT_KEY = 'amount';
    public static $PARTNER_ID_KEY = 'partner_id';
    public static $PARTNER_ENTRY_KEY = 'partner_entry_id';
    public static $PARTNER_AMOUNT_KEY = 'partner_amount';

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
     * Sets the maximum value allowed for the amount value, enforced during validation.
     * @param int $size
     */
    public function setMaxAmountRule($size)
    {
        $this->rules[self::$AMOUNT_KEY][self::$MAX_KEY] = 'max:' . $size;
    }
}