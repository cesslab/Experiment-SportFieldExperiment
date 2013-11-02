<?php namespace SportExperiment\Domain\Model;

use Illuminate\Auth\UserInterface;

class User extends BaseModel implements UserInterface
{
    protected $rules = array(
        'username'=>'required|alpha_num|min:3|max:16', 
        'password'=>'required|alpha_num|min:3|max:16');

    protected $whitelist = array('id', 'username', 'active', 'password');

    protected $id;
    protected $username;
    protected $active;
    protected $password;

    public function __construct($properties = array())
    {
        parent::__construct($properties);
    }


    public function getAuthIdentifier()
    {
        return $this->username;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

        public function getAuthInfo()
    {
        return array('username'=>$this->username, 'password'=>$this->password);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserName()
    {
        return $this->username;
    }

    public function setUserName($username)
    {
        $this->username = $username;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
