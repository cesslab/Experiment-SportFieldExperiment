<?php namespace SportExperiment\Framework\Repository\Eloquent;

class Subject extends BaseEloquent
{
    protected $table = 'experiment_sessions';
    protected $fillable = array('first_name', 'last_name', 'session_id', 'profession', 'education', 'gender', 'age', 'ethnicity');

    public $first_name;
    public $last_name;
    public $profession;
    public $education;
    public $gender;
    public $age;
    public $ethnicity;
    public $session_id;

    public function user()
    {
        return $this->belongsTo(User::getNamespace(), 'user_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), 'session_id');
    }


    /**
     * @param mixed $session_id
     */
    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @param mixed $education
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    /**
     * @param mixed $ethnicity
     */
    public function setEthnicity($ethnicity)
    {
        $this->ethnicity = $ethnicity;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @return mixed
     */
    public function getEthnicity()
    {
        return $this->ethnicity;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }


}