<?php namespace SportExperiment\Model;


interface GroupTreatmentInterface
{
    /**
     * @param $groups \SportExperiment\Model\Group[]
     */
    public function saveGroups($groups);
}