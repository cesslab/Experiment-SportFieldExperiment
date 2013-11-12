<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\User;

interface ResearcherRepositoryInterface
{

    public function isResearcher(User $user);

    public function saveSession(ModelCollection $modelCollection);

    public function getSessions();

    public function getSubjects();
}

