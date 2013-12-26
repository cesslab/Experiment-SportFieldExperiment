<?php namespace SportExperiment\Model\Eloquent;

class SubjectEntryState extends BaseEloquent
{
    public static $TABLE_KEY = 'subject_entry_state';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $ORDER_ID_KEY = 'order_id';
    public static $TASK_ID_KEY = 'task_id';
    public static $TASK_ENTRY_STATE_KEY = 'tasks_entry_state';
    public static $COMMERCIAL_BREAK_ENTRY_KEY = 'commercial_break_entry';

    public $timestamps = false;

    public static $TASK_ENTRIES_COMPLETE = true;
    public static $TASK_ENTRIES_REQUIRED = false;
    public static $FIRST_TASK = 0;

    protected $table;
    protected $fillable;
    protected $rules;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = []){
        $this->table = self::$TABLE_KEY;
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

    /**
     * @return bool
     */
    public function taskEntriesComplete()
    {
        return $this->getTaskEntryState() == self::$TASK_ENTRIES_COMPLETE;
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    public function setSubjectId($subjectId)
    {
        $this->setAttribute(self::$SUBJECT_ID_KEY, $subjectId);
    }

    public function setTaskId($treatmentId)
    {
        $this->setAttribute(self::$TASK_ID_KEY, $treatmentId);
    }

    public function setTaskEntryState($state)
    {
        $this->setAttribute(self::$TASK_ENTRY_STATE_KEY, $state);
    }

    public function setCommercialBreakEntry($entryNumber)
    {
        $this->setAttribute(self::$COMMERCIAL_BREAK_ENTRY_KEY, $entryNumber);
    }

    public function getSubjectId()
    {
        return $this->getAttribute(self::$SUBJECT_ID_KEY);
    }

    public function getTaskId()
    {
        return $this->getAttribute(self::$TASK_ID_KEY);
    }

    public function getOrderId()
    {
        return $this->getAttribute(self::$ORDER_ID_KEY);
    }

    public function setOrderId($orderId)
    {
        $this->setAttribute(self::$ORDER_ID_KEY, $orderId);
    }

    public function getNextOrderId()
    {
        return $this->getOrderId() + 1;
    }

    public function getTaskEntryState()
    {
        return $this->getAttribute(self::$TASK_ENTRY_STATE_KEY);
    }

    public function getCommercialBreakEntry()
    {
        return $this->getAttribute(self::$COMMERCIAL_BREAK_ENTRY_KEY);
    }
}