<?php namespace SportExperiment\Repository\Eloquent;

class Subject extends BaseEloquent
{
    public static $TABLE_KEY = 'experiment_sessions';

    public static $ID_KEY = 'id';
    public static $USER_ID_KEY = 'user_id';
    public static $FIRST_NAME_KEY = 'first_name';
    public static $LAST_NAME_KEY = 'last_name';
    public static $SESSION_ID_KEY = 'session_id';
    public static $PROFESSION_KEY = 'profession';
    public static $EDUCATION_KEY = 'education';
    public static $GENDER_KEY = 'gender';
    public static $AGE_KEY = 'age';
    public static $ETHNICITY_KEY = 'ethnicity';
    public static $ACTIVE_KEY = 'active';

    protected $table;
    protected $fillable;

    public function __construct($attributes = array())
    {
        $this->table = self::$TABLE_KEY;

        $this->fillable = array(self::$FIRST_NAME_KEY, self::$USER_ID_KEY, self::$LAST_NAME_KEY, self::$SESSION_ID_KEY,
            self::$PROFESSION_KEY, self::$EDUCATION_KEY, self::$GENDER_KEY, self::$AGE_KEY, self::$ACTIVE_KEY, self::$ETHNICITY_KEY);

        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(User::getNamespace(), 'user_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), 'session_id');
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