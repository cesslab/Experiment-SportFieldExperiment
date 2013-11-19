<?php namespace SportExperiment\Model\Eloquent;


class TrustEntry extends BaseEloquent
{
    public static $TABLE_KEY = 'trust_entries';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $SELECTED_FOR_PAYOFF = 'selected_for_payoff';
    public static $PAYOFF_KEY = 'payoff';

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
        ];

        $this->fillable = [];

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

    public function trustAllocationEntries()
    {
        return $this->hasMany(TrustAllocationEntry::getNamespace(), TrustAllocationEntry::$TRUST_ENTRY_ID_KEY);
    }


    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/
    /**
     * @param $isSelected
     */
    public function setSelectedForPayoff($isSelected)
    {
        $this->setAttribute(self::$SELECTED_FOR_PAYOFF, $isSelected);
    }

    /**
     * @param $payoff
     */
    public function setPayoff($payoff)
    {
        $this->setAttribute(self::$PAYOFF_KEY, $payoff);
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
    public function getSelectedForPayoff()
    {
        return $this->getAttribute(self::$SELECTED_FOR_PAYOFF);
    }

} 