<?php namespace SportExperiment\Repository;

use SportExperiment\Repository\Eloquent\User;

interface ResearcherRepositoryInterface
{

    public function isResearcher(User $user);

    public function saveSession(ModelCollection $modelCollection);

    public function getSessions();

    public function getSubjects();
}

