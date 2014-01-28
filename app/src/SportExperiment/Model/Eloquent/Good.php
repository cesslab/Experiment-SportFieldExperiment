<?php namespace SportExperiment\Model\Eloquent;


class Good extends BaseEloquent
{
    public static $TABLE_KEY = 'good';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $GOOD_KEY = 'good';

    public $timestamps = true;

    public static $GOODS = ['Winter Hat', 'Headphones', 'Video Streaming Device'];

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
            self::$GOOD_KEY=>['required', 'integer','in:0,1,2'],
        ];

        $this->fillable = [self::$GOOD_KEY];

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

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @return array
     */
    public static function getGoods()
    {
        return self::$GOODS;
    }

    /**
     * @return mixed
     */
    public function getGood()
    {
        return $this->getAttribute(self::$GOOD_KEY);
    }
}