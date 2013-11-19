<?php namespace SportExperiment\Model\Eloquent;

class TrustAllocationEntry extends BaseEloquent
{
    public static $TABLE_KEY = 'trust_receiver_entries';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $TRUST_ENTRY_ID_KEY = 'trust_entry_id';
    public static $ALLOCATION_ID_KEY = 'allocation_id';
    public static $ALLOCATION_KEY = 'allocation';

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
            self::$ALLOCATION_ID_KEY=>'required|integer|min:0|max:4',
            self::$ALLOCATION_KEY=>'required|integer|min:0|max:4',
        ];

        $this->fillable = [self::$ALLOCATION_ID_KEY, self::$ALLOCATION_KEY];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/
    public function trustEntry()
    {
        return $this->belongsTo(TrustEntry::getNamespace(), TrustEntry::$ID_KEY);
    }


    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    public function getAllocationId()
    {
        return $this->getAttribute(self::$ALLOCATION_ID_KEY);
    }

    public function getAllocation()
    {
        return $this->getAttribute(self::$ALLOCATION_KEY);
    }

} 