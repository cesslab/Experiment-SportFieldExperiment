<?php namespace SportExperiment\Domain\Repository;

use SportExperiment\Domain\Model\ModelCollection;
use SportExperiment\Domain\Model\User;

interface ResearcherRepositoryInterface
{

    public function isResearcher(User $user);

    public function saveSession(ModelCollection $modelCollection);

    public function getSessions();
}

