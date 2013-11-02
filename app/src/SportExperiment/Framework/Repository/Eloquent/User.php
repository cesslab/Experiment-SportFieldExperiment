<?php namespace SportExperiment\Framework\Repository\Eloquent;

use Illuminate\Auth\UserInterface;

class User extends BaseEloquent implements UserInterface {
    public static $ID_KEY = 'id';
    public static $USER_NAME_KEY = 'user_name';
    public static $ROLE_KEY = 'role';
    public static $PASSWORD_KEY = 'password';
    public static $ACTIVE_KEY = 'active';

    protected $fillable;

	protected $table = 'users';
	protected $hidden = array('password');

    public function __construct($attributes = array())
    {
        $this->fillable = array(self::$USER_NAME_KEY, self::$PASSWORD_KEY, self::$ROLE_KEY, self::$ACTIVE_KEY);
        parent::__construct($attributes);
    }

    public function subject()
    {
        return $this->hasOne(Subject::getNamespace(), 'user_id');
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->setAttribute(self::$ACTIVE_KEY, $active);
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->getAttribute(self::$ACTIVE_KEY);
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->setAttribute(self::$PASSWORD_KEY, $password);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getAttribute(self::$PASSWORD_KEY);
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->setAttribute(self::$ROLE_KEY, $role);
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->setAttribute(self::$USER_NAME_KEY, $username);
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->getAttribute(self::$ROLE_KEY);
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->getAttribute(self::$USER_NAME_KEY);
    }

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
        return $this->getAttribute(self::$ID_KEY);
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
        return $this->getAttribute(self::$PASSWORD_KEY);
	}
}