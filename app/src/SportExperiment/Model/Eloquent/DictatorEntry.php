<?php namespace SportExperiment\Model\Eloquent;


class DictatorEntry extends TaskEntry
{
    public static $TABLE_KEY = 'dictator_entries';

    public static $DICTATOR_ALLOCATION_KEY = 'dictator_allocation';

    protected $rules;
    protected $table;
    protected $fillable;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;
        $this->rules = [self::$DICTATOR_ALLOCATION_KEY=>['required', 'numeric', 'min:0']];

        $this->fillable = [self::$DICTATOR_ALLOCATION_KEY];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @return mixed
     */
    public function getDictatorAllocation()
    {
        return $this->getAttribute(self::$DICTATOR_ALLOCATION_KEY);
    }

    /**
     * Sets the maximum value allowed for the amount value, enforced during validation.
     * @param int $size
     */
    public function setMaxAllocationRule($size)
    {
        $this->rules[self::$DICTATOR_ALLOCATION_KEY][] = 'max:' . $size;
    }
}
