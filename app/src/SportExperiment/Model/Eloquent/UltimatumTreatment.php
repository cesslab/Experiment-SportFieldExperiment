<?php namespace SportExperiment\Model\Eloquent;


class UltimatumTreatment extends BaseEloquent
{
    public static $TABLE_KEY = 'ultimatum_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $TOTAL_AMOUNT_KEY = 'total_amount';

    private static $TASK_ID = 3;

    public $timestamps = false;

    protected $table;
    protected $fillable;
    protected $rules;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = []){
        $this->table = self::$TABLE_KEY;

        $this->fillable = [self::$TOTAL_AMOUNT_KEY];

        $this->rules = [
            self::$LOW_PRIZE_KEY=>'required|numeric|min:0|max:1000000'
        ];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/

} 