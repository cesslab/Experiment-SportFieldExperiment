<?php namespace SportExperiment\Model\Eloquent;


class Charity extends BaseEloquent
{
    public static $TABLE_KEY = 'charity';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $CHARITY_KEY = 'charity';

    public $timestamps = true;

    public static $CHARITIES = ['United Way', 'American Cancer Society', 'World Wildlife Fund'];

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
            self::$CHARITY_KEY=>['required', 'integer','in:0,1,2'],
        ];

        $this->fillable = [self::$CHARITY_KEY];

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
    public static function getCharities()
    {
        return self::$CHARITIES;
    }

    public function getCharity()
    {
        return $this->getAttribute(self::$CHARITY_KEY);
    }

} 