<?php namespace SportExperiment\Model\Eloquent;

class TrustProposerEntry extends BaseEloquent
{
    public static $TABLE_KEY = 'trust_proposer_entries';

    public static $ID_KEY = 'id';
    public static $TRUST_ENTRY_ID_KEY = 'trust_entry_id';
    public static $ALLOCATION_KEY = 'allocation';

    private static $MAX_PROPOSER_ALLOCATIONS = 1;

    public $timestamps = false;

    protected $table;
    protected $rules = [];
    protected $fillable;

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
        $allocationOptions = $treatment->getProposerAllocationOptions();
        $values = implode(",", $allocationOptions);
        $this->rules[self::$ALLOCATION_KEY] = ['required', 'numeric', "in:{$values}"];
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @return int
     */
    public static function getMaxNumProposerAllocations()
    {
        return self::$MAX_PROPOSER_ALLOCATIONS;
    }

    /**
     * @return string
     */
    public static function getAllocationKey()
    {
        return self::$ALLOCATION_KEY;
    }

    /**
     * @return mixed
     */
    public function getAllocation()
    {
        return $this->getAttribute(self::$ALLOCATION_KEY);
    }

    /**
     * @return mixed
     */
    public function getAllocationEntry()
    {
        return $this->getAttribute(self::$ALLOCATION_KEY);
    }

    /**
     * @param $allocation
     */
    public function setAllocation($allocation)
    {
        $this->setAttribute(self::$ALLOCATION_KEY, $allocation);
    }
}