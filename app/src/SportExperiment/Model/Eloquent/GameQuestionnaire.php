<?php namespace SportExperiment\Model\Eloquent;

use SportExperiment\Model\NFLTeams;

class GameQuestionnaire extends BaseEloquent
{
    public static $TABLE_KEY = 'game_questionnaire';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $LEVEL_SURPRISE_KEY = 'level_surprise';
    public static $LEVEL_EXCITATION_KEY = 'level_excitation';
    public static $LEVEL_HAPPINESS_KEY = 'level_happiness';
    public static $LIKELINESS_WINNING_KEY = 'likeliness_winning';

    public static $OPTION_RANGE = [1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5', 6=>'6', 7=>'7'];

    public $timestamps = true;

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
            self::$LEVEL_SURPRISE_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$LEVEL_EXCITATION_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$LEVEL_HAPPINESS_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$LIKELINESS_WINNING_KEY=>['required','in:'. implode(',', range(0, 100))],
        ];

        $this->fillable = [
            self::$LEVEL_SURPRISE_KEY, self::$LEVEL_EXCITATION_KEY,
            self::$LEVEL_HAPPINESS_KEY, self::$LIKELINESS_WINNING_KEY];

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
    public static function getOptionRange()
    {
        return self::$OPTION_RANGE;
    }

}
