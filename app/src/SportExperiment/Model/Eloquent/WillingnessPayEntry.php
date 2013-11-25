<?php namespace SportExperiment\Model\Eloquent;

class WillingnessPayEntry extends TaskEntry
{
    public static $TABLE_KEY = 'willingness_pay_entries';

    public static $WILLING_PAY_KEY = 'willing_pay';
    public static $ITEM_PURCHASED_KEY = 'item_purchased';

    protected $rules;
    protected $table;
    protected $fillable;

    /**
     * @param array $attributes
     * @param string $endowment
     */
    public function __construct($attributes = [], $endowment = '100')
    {
        $this->table = self::$TABLE_KEY;

        $maxEndowment = sprintf("max:%s", $endowment);
        $this->rules = [self::$WILLING_PAY_KEY=>['required', 'numeric', 'min:0', $maxEndowment]];
        $this->fillable = [self::$WILLING_PAY_KEY];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @param $willingnessPay
     */
    public function setWillingnessPay($willingnessPay)
    {
        $this->setAttribute(self::$WILLING_PAY_KEY, $willingnessPay);
    }

    /**
     * @param $itemPurchased
     */
    public function setItemPurchased($itemPurchased)
    {
        $this->setAttribute(self::$ITEM_PURCHASED_KEY, $itemPurchased);
    }

    /**
     * @return mixed
     */
    public function getWillingnessPay()
    {
        return $this->getAttribute(self::$WILLING_PAY_KEY);
    }

    /**
     * @return mixed
     */
    public function getItemPurchased()
    {
        return $this->getAttribute(self::$ITEM_PURCHASED_KEY);
    }
}