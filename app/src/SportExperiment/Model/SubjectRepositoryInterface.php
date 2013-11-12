<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\Subject;

interface SubjectRepositoryInterface
{
    /**
     * @param Subject $subject
     * @param ModelCollection $collection
     * @return mixed
     */
    public function saveSubjectData(Subject $subject, ModelCollection $collection);
}
