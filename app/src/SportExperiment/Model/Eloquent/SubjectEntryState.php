<?php namespace SportExperiment\Model\Eloquent;

class SubjectEntryState extends BaseEloquent
{
    public static $TABLE_KEY = 'subject_entry_state';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $CURRENT_TASK_ID_KEY = 'task_id';
    public static $TASKS_COMPLETED_KEY = 'tasks_completed';
    public static $QUESTIONS_COMPLETED_KEY = 'question_completed';

    public $timestamps = false;

    public static $NO_TREATMENT_ID_SET = 0;

    protected $table;
    protected $fillable;
    protected $rules;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = []){
        $this->table = self::$TABLE_KEY;
        $this->fillable = [];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::getNamespace(), self::$SUBJECT_ID_KEY);
    }

    /**
     * @return bool
     */
    public function isTreatmentSet()
    {
        return $this->getCurrentTaskId() != self::$NO_TREATMENT_ID_SET;
    }

    /**
     * @return bool
     */
    public function isTreatmentPhaseComplete()
    {
        return $this->getTreatmentCompleted() == true;
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    public function setSubjectId($subjectId)
    {
        $this->setAttribute(self::$SUBJECT_ID_KEY, $subjectId);
    }

    public function setCurrentTaskId($treatmentId)
    {
        $this->setAttribute(self::$CURRENT_TASK_ID_KEY, $treatmentId);
    }

    public function setTasksCompleted($completed)
    {
        $this->setAttribute(self::$TASKS_COMPLETED_KEY, $completed);
    }

    public function getSubjectId()
    {
        return $this->getAttribute(self::$SUBJECT_ID_KEY);
    }

    public function getCurrentTaskId()
    {
        return $this->getAttribute(self::$CURRENT_TASK_ID_KEY);
    }

    public function getTreatmentCompleted()
    {
        return $this->getAttribute(self::$TASKS_COMPLETED_KEY);
    }

    public function getQuestionsCompleted()
    {
        return $this->getAttribute(self::$QUESTIONS_COMPLETED_KEY);
    }
}