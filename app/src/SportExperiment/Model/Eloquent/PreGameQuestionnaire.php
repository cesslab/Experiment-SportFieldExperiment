<?php namespace SportExperiment\Model\Eloquent;

use SportExperiment\Model\NFLTeams;

class PreGameQuestionnaire extends BaseEloquent
{
    public static $TABLE_KEY = 'pre_game_questionnaire';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $SPORT_FAN_KEY = 'sport_fan';
    public static $FOOTBALL_FAN_KEY = 'football_fan';
    public static $FAVORITE_TEAM_KEY = 'favorite_team';
    public static $FAVORED_TEAM_KEY = 'favored_team';
    public static $MEASURE_FAVORED_TEAM_KEY = 'measure_favored_team';

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
            self::$SPORT_FAN_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$FOOTBALL_FAN_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$FAVORITE_TEAM_KEY=>['required', 'integer', 'min:0', 'max:' . NFLTeams::numTeams()],
            self::$FAVORED_TEAM_KEY=>['required', 'integer', 'min:0', 'max:' . NFLTeams::numTeams()],
            self::$MEASURE_FAVORED_TEAM_KEY=>['required', 'in:0,1,2,3,4,5,6,7']
        ];

        $this->fillable = [
            self::$SPORT_FAN_KEY, self::$FOOTBALL_FAN_KEY, self::$FAVORITE_TEAM_KEY, self::$FAVORED_TEAM_KEY,
            self::$MEASURE_FAVORED_TEAM_KEY
        ];

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

    /**
     * Returns the sport fan key.
     *
     * @return string
     */
    public static function getSportFanKey()
    {
        return self::$SPORT_FAN_KEY;
    }

    /**
     * Returns the football fan key.
     *
     * @return string
     */
    public static function getFootballFanKey()
    {
        return self::$FOOTBALL_FAN_KEY;
    }

    /**
     * Returns the favorite team key.
     *
     * @return string
     */
    public static function getFavoriteTeamKey()
    {
        return self::$FAVORITE_TEAM_KEY;
    }

    /**
     * Returns the favored team key.
     *
     * @return string
     */
    public static function getFavoredTeamKey()
    {
        return self::$FAVORED_TEAM_KEY;
    }

    /**
     * Returns the measure of favored team key.
     *
     * @return string
     */
    public static function getMeasureFavoredTeamKey()
    {
        return self::$MEASURE_FAVORED_TEAM_KEY;
    }

}