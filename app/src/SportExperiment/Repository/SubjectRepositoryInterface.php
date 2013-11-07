<?php namespace SportExperiment\Repository;

use SportExperiment\Repository\Eloquent\Subject;

interface SubjectRepositoryInterface
{
    public function saveSubjectData(Subject $subject, ModelCollection $collection);
}
