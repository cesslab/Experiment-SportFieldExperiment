<?php namespace SportExperiment\Model\Eloquent;


class TaskEntry extends BaseEloquent
{
    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $SELECTED_FOR_PAYOFF = 'selected_for_payoff';
    public static $PAYOFF_KEY = 'payoff';

    public function __construct($attributes)
    {
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

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    /**
     * @param $subjectId
     */
    public function setSubjectId($subjectId)
    {
        $this->setAttribute(self::$SUBJECT_ID_KEY, $subjectId);
    }

    /**
     * @param $isSelected
     */
    public function setSelectedForPayoff($isSelected)
    {
        $this->setAttribute(self::$SELECTED_FOR_PAYOFF, $isSelected);
    }

    /**
     * @param $payoff
     */
    public function setPayoff($payoff)
    {
        $this->setAttribute(self::$PAYOFF_KEY, $payoff);
    }

    /**
     * @return mixed
     */
    public function getPayoff()
    {
        return $this->getAttribute(self::$PAYOFF_KEY);
    }

    /**
     * @return mixed
     */
    public function getSelectedForPayoff()
    {
        return $this->getAttribute(self::$SELECTED_FOR_PAYOFF);
    }

} 