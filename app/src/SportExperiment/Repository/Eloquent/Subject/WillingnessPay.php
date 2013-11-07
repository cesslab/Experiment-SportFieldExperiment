<?php namespace SportExperiment\Repository\Eloquent\Subject;

use SportExperiment\Repository\Eloquent\BaseEloquent;
use SportExperiment\Repository\Eloquent\Subject;

class WillingnessPay extends BaseEloquent
{
    public static $TABLE_KEY = 'subject_willingness_pay';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $WILLING_PAY_KEY = 'willing_pay';

    protected $rules;
    protected $table;
    protected $fillable;

    public function __construct($attributes = array(), $endowment = '100')
    {
        $this->table = self::$TABLE_KEY;
        $this->rules = array(
            self::$WILLING_PAY_KEY=>'required|numeric|min:2|max:'.$endowment,
        );

        $this->fillable = array(self::$WILLING_PAY_KEY);

        parent::__construct($attributes);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::getNamespace(), self::$SUBJECT_ID_KEY);
    }

    public function setWillingnessPay($willingnessPay)
    {
        $this->setAttribute(self::$WILLING_PAY_KEY, $willingnessPay);
    }

    public function getWillingnessPay()
    {
        return $this->getAttribute(self::$WILLING_PAY_KEY);
    }
}