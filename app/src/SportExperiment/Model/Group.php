<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\Subject;

class Group {

    private $subjects = [];

    /**
     * @param string|int $role
     * @return Eloquent\Subject
     */
    public function getSubject($role)
    {
        return $this->subjects[$role];
    }

    /**
     * @param Subject $subject
     * @param string|int $role
     */
    public function setSubject(Subject $subject, $role)
    {
        $this->subjects[$role] = $subject;
    }
}