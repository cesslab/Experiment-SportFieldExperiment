<?php namespace SportExperiment\Repository\Eloquent;

use SportExperiment\Repository\Eloquent\Subject\Payoff;
use SportExperiment\Repository\Eloquent\Subject\RiskAversion;
use SportExperiment\Repository\Eloquent\Subject\WillingnessPay;

class Subject extends BaseEloquent
{
    public static $TABLE_KEY = 'subjects';

    public static $ID_KEY = 'id';
    public static $GAME_STATE_KEY = 'game_state';
    public static $USER_ID_KEY = 'user_id';
    public static $FIRST_NAME_KEY = 'first_name';
    public static $LAST_NAME_KEY = 'last_name';
    public static $SESSION_ID_KEY = 'session_id';
    public static $PROFESSION_KEY = 'profession';
    public static $EDUCATION_KEY = 'education';
    public static $GENDER_KEY = 'gender';
    public static $AGE_KEY = 'age';
    public static $ETHNICITY_KEY = 'ethnicity';

    protected $rules;
    protected $table;
    protected $fillable;

    public function __construct($attributes = array())
    {
        $this->table = self::$TABLE_KEY;
        $this->rules = array(
            self::$FIRST_NAME_KEY=>'required|alpha|min:2|max:100',
            self::$LAST_NAME_KEY=>'required|alpha|min:2|max:100',
            self::$PROFESSION_KEY=>'required|alpha|min:2|max:250',
            self::$EDUCATION_KEY=>'required|alpha|min:2|max:250',
            self::$GENDER_KEY=>'required|alpha|in:male,female',
            self::$AGE_KEY=>'required|integer|min:18|max:100',
            self::$ETHNICITY_KEY=>'required|alpha|min:2|max:100'
        );

        $this->fillable = array(self::$FIRST_NAME_KEY, self::$LAST_NAME_KEY,
            self::$PROFESSION_KEY, self::$EDUCATION_KEY, self::$GENDER_KEY, self::$AGE_KEY, self::$ETHNICITY_KEY);

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/
    public function riskAversionEntries()
    {
        return $this->hasMany(RiskAversion::getNamespace(), RiskAversion::$SUBJECT_ID_KEY);
    }

    public function willingnessPayEntries()
    {
        return $this->hasMany(WillingnessPay::getNamespace(), WillingnessPay::$SUBJECT_ID_KEY);
    }

    public function user()
    {
        return $this->belongsTo(User::getNamespace(), self::$USER_ID_KEY);
    }

    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), self::$SESSION_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    public function setId($id)
    {
        $this->setAttribute(self::$ID_KEY, $id);
    }

    public function getId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    /**
     * @param mixed $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->setAttribute(self::$ID_KEY, $sessionId);
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->setAttribute(self::$AGE_KEY, $age);
    }

    /**
     * @param mixed $education
     */
    public function setEducation($education)
    {
        $this->setAttribute(self::$EDUCATION_KEY, $education);
    }

    /**
     * @param mixed $ethnicity
     */
    public function setEthnicity($ethnicity)
    {
        $this->setAttribute(self::$ETHNICITY_KEY, $ethnicity);
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->setAttribute(self::$FIRST_NAME_KEY, $firstName);
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->setAttribute(self::$GENDER_KEY, $gender);
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->setAttribute(self::$LAST_NAME_KEY, $lastName);
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession)
    {
        $this->setAttribute(self::$PROFESSION_KEY, $profession);
    }

    public function setState($subjectGameState)
    {
        $this->setAttribute(self::$GAME_STATE_KEY, $subjectGameState);
    }

    public function getState()
    {
        return $this->getAttribute(self::$GAME_STATE_KEY);
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->getAttribute(self::$AGE_KEY);
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->getAttribute(self::$EDUCATION_KEY);
    }

    /**
     * @return mixed
     */
    public function getEthnicity()
    {
        return $this->getAttribute(self::$ETHNICITY_KEY);
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->getAttribute(self::$FIRST_NAME_KEY);
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->getAttribute(self::$GENDER_KEY);
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->getAttribute(self::$LAST_NAME_KEY);
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->getAttribute(self::$PROFESSION_KEY);
    }
}