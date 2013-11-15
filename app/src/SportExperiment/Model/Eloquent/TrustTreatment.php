<?php namespace SportExperiment\Model\Eloquent;


class TrustTreatment extends BaseEloquent
{
    public static $TABLE_KEY = 'trust_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $SENDER_MULTIPLIER_KEY = 'sender_multiplier';
    public static $RECEIVER_MULTIPLIER_KEY = 'receiver_multiplier';

    private static $TASK_ID = 4;

    public $timestamps = false;

    protected $table;
    protected $fillable;
    protected $rules;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = []){
        $this->table = self::$TABLE_KEY;

        $this->fillable = [self::$SENDER_MULTIPLIER_KEY, self::$RECEIVER_MULTIPLIER_KEY];

        $this->rules = [
            self::$SENDER_MULTIPLIER_KEY=>'required|numeric|min:0|max:1000000',
            self::$RECEIVER_MULTIPLIER_KEY=>'required|numeric|min:0|max:1000000'
        ];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), self::$SESSION_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/
    /**
     * Returns the Task ID.
     *
     * @return int
     */
    public static function getTaskId()
    {
        return self::$TASK_ID;
    }

} 