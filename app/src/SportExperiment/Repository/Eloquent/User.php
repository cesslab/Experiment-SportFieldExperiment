<?php namespace SportExperiment\Repository\Eloquent;

use Illuminate\Auth\UserInterface;
use Illuminate\Support\Facades\Hash;
use SportExperiment\Repository\Eloquent\Role;

class User extends BaseEloquent implements UserInterface
{
    public static $TABLE_KEY = 'users';

    public static $ID_KEY = 'id';
    public static $USER_NAME_KEY = 'user_name';
    public static $ROLE_KEY = 'role';
    public static $PASSWORD_KEY = 'password';
    public static $ACTIVE_KEY = 'active';

    protected $rules;
    protected $fillable;
	protected $table;

	protected $hidden = array('password');

    public function __construct($attributes = array())
    {
        $this->table = self::$TABLE_KEY;
        $this->fillable = array(self::$USER_NAME_KEY, self::$PASSWORD_KEY, self::$ROLE_KEY, self::$ACTIVE_KEY);
        $this->rules = array(
            self::$USER_NAME_KEY=>'required|alpha_num|min:1|max:16',
            self::$PASSWORD_KEY=>'required|alpha_num|min:1|max:16');

        parent::__construct($attributes);
    }

    public function subject()
    {
        return $this->hasOne(Subject::getNamespace(), Subject::$USER_ID_KEY);
    }

    public function researcher()
    {
        return $this->hasOne(Subject::getNamespace(), Researcher::$USER_ID_KEY);
    }

    public function isRole(Role $role)
    {
        $userModel = User::where(self::$USER_NAME_KEY, $this->getUserName())
            ->where(self::$ROLE_KEY, $role->getRole())
            ->where(self::$ACTIVE_KEY, true)->first();

        // Researcher not found
        if ($userModel == null)
            return false;

        return Hash::check($this->getPassword(), $userModel->password);

    }

    public function getAuthInfo()
    {
        return array(self::$USER_NAME_KEY=>$this->getUserName(), self::$PASSWORD_KEY=>$this->getPassword());
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