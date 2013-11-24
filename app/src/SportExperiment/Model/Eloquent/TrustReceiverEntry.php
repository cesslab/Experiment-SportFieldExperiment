<?php namespace SportExperiment\Model\Eloquent;

class TrustReceiverEntry extends BaseEloquent
{
    public static $TABLE_KEY = 'trust_receiver_entries';

    public static $ID_KEY = 'id';
    public static $TRUST_ENTRY_ID_KEY = 'trust_entry_id';
    public static $PROPOSER_ALLOCATION_KEY = 'proposer_allocation';
    public static $ALLOCATION_KEY = 'allocation';

    private static $MAX_RECEIVER_ALLOCATIONS = 4;

    public $timestamps = false;

    protected $table;
    protected $rules = [];
    protected $fillable;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->fillable = [self::$ALLOCATION_KEY];
        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trustEntry()
    {
        return $this->belongsTo(TrustEntry::getNamespace(), self::$TRUST_ENTRY_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Model Business Logic
     * ---------------------------------------------------------------------*/

    /**
     * @param TrustTreatment $treatment
     */
    public function setValidationRules(TrustTreatment $treatment)
    {
        $allocationOptions = $treatment->getReceiverAllocationOptions();
        $this->rules = [];
        foreach ($allocationOptions as $option) {
            $this->rules[self::$ALLOCATION_KEY.".{$option}"] = ['required', 'numeric', 'min:0', "max:{$option}"];
        }
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/
    /**
     * @return int
     */
    public static function getMaxNumReceiverAllocations()
    {
        return self::$MAX_RECEIVER_ALLOCATIONS;
    }

    /**
     * @return mixed
     */
    public function getAllocation()
    {
        return $this->getAttribute(self::$ALLOCATION_KEY);
    }

    /**
     * @param $allocation
     */
    public function setProposerAllocation($allocation)
    {
        $this->setAttribute(self::$PROPOSER_ALLOCATION_KEY, $allocation);
    }

    /**
     * @param $allocation
     */
    public function setAllocation($allocation)
    {
        $this->setAttribute(self::$ALLOCATION_KEY, $allocation);
    }
}