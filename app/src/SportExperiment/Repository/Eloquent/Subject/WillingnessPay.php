<?php namespace SportExperiment\Repository\Eloquent\Subject;

use SportExperiment\Repository\Eloquent\BaseEloquent;
use SportExperiment\Repository\Eloquent\Subject;

class WillingnessPay extends BaseEloquent
{
    public static $TABLE_KEY = 'subject_willingness_pay';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $WILLING_PAY_KEY = 'willing_pay';
    public static $PAYOFF_KEY = 'payoff';
    public static $ITEM_PURCHASED_KEY = 'item_purchased';
    public static $SELECTED_FOR_PAYOFF = 'selected_for_payoff';

    protected $rules;
    protected $table;
    protected $fillable;

    public function __construct($attributes = [], $endowment = '100')
    {
        $this->table = self::$TABLE_KEY;

        $maxEndowment = sprintf("max:%s", $endowment);
        $this->rules = [self::$WILLING_PAY_KEY=>['required', 'numeric', 'min:0', $maxEndowment]];
        $this->fillable = [self::$WILLING_PAY_KEY];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/

    public function subject()
    {
        return $this->belongsTo(Subject::getNamespace(), self::$SUBJECT_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    public function setWillingnessPay($willingnessPay)
    {
        $this->setAttribute(self::$WILLING_PAY_KEY, $willingnessPay);
    }

    public function setPayoff($payoff)
    {
        $this->setAttribute(self::$PAYOFF_KEY, $payoff);
    }

    public function setItemPurchased($itemPurchased)
    {
        $this->setAttribute(self::$ITEM_PURCHASED_KEY, $itemPurchased);
    }

    public function setSelectedForPayoff($isSelected)
    {
        $this->setAttribute(self::$SELECTED_FOR_PAYOFF, $isSelected);
    }

    public function getWillingnessPay()
    {
        return $this->getAttribute(self::$WILLING_PAY_KEY);
    }

    public function getPayoff()
    {
        return $this->getAttribute(self::$PAYOFF_KEY);
    }

    public function getItemPurchased()
    {
        return $this->getAttribute(self::$ITEM_PURCHASED_KEY);
    }

    public function getSelectedForPayoff()
    {
        //TODO: Extract common treatment functions into a Treatment parent class, which extends BaseEloquent.
        return $this->getAttribute(self::$SELECTED_FOR_PAYOFF);
    }
}