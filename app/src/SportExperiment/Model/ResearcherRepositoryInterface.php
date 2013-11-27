<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\User;

interface ResearcherRepositoryInterface
{

    /**
     * @param User $user
     * @return bool
     */
    public function isResearcher(User $user);

    /**
     * @param ModelCollection $modelCollection
     * @return mixed
     */
    public function saveSession(ModelCollection $modelCollection);

    /**
     * @param $id
     * @return Eloquent\Session
     */
    public function getSession($id);

    /**
     * @return Eloquent\Session[]
     */
    public function getSessions();

    /**
     * @return Eloquent\Subject[]
     */
    public function getSubjects();
}

