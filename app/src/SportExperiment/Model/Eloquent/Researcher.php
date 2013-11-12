<?php namespace SportExperiment\Model\Eloquent;

class Researcher extends BaseEloquent
{
    public static $TABLE_KEY = 'researchers';

    public static $ID_KEY = 'id';
    public static $USER_ID_KEY = 'user_id';
    public static $FIRST_NAME_KEY = 'first_name';
    public static $LAST_NAME_KEY = 'last_name';
    public static $EMAIL_KEY = 'email';


    public $timestamps = false;

    protected $table;
    protected $fillable;

    function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;
        $this->fillable = [self::$FIRST_NAME_KEY, self::$LAST_NAME_KEY, self::$EMAIL_KEY];

        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(User::getNamespace(), self::$USER_ID_KEY);
    }

    public function getFirstName()
    {
        return $this->getAttribute(self::$FIRST_NAME_KEY);
    }

    public function getLastName()
    {
        return $this->getAttribute(self::$LAST_NAME_KEY);
    }

    public function getEmail()
    {
        return $this->getAttribute(self::$EMAIL_KEY);
    }

    public function setFirstName($firstName)
    {
        $this->setAttribute(self::$FIRST_NAME_KEY, $firstName);
    }

    public function setLastName($lastName)
    {
        $this->setAttribute(self::$LAST_NAME_KEY, $lastName);
    }

    public function setEmail($email)
    {
        $this->setAttribute(self::$EMAIL_KEY, $email);
    }

}