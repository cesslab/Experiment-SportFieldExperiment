<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\Subject;

interface TreatmentInterface
{
    /**
     * Returns the treatments Task ID.
     *
     * @return int
     */
    public static function getTaskId();

    /**
     * Calculate the treatment payoffs for the specified subject.
     *
     * @param Subject $subject
     */
    public function calculatePayoff(Subject $subject);

    /**
     * Returns the treatment Id
     * @return mixed
     */
    public function getId();

    /**
     * Sets the treatment task ID.
     *
     * @param $taskId
     */
    public function setTreatmentTaskId($taskId);

    /**
     * Returns the treatment task Id.
     *
     * @return mixed
     */
    public function getTreatmentTaskId();
}