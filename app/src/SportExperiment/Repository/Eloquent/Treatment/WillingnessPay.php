<?php namespace SportExperiment\Repository\Eloquent\Treatment;

use SportExperiment\Repository\Eloquent\BaseEloquent;
use SportExperiment\Repository\Eloquent\Session;
use SportExperiment\Repository\Eloquent\Subject;
use SportExperiment\Repository\Eloquent\Subject\WillingnessPay as SubjectWillingnessPay;

class WillingnessPay extends BaseEloquent
{
    public static $TABLE_KEY = 'willingness_to_pay_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $ENDOWMENT_KEY = 'endowment';

    public $timestamps = false;

    protected $table;
    protected $fillable;
    protected $rules;

    public function __construct($attributes = array()){
        $this->table = self::$TABLE_KEY;
        $this->fillable = array(self::$SESSION_ID_KEY, self::$ENDOWMENT_KEY);
        $this->rules = array(self::$ENDOWMENT_KEY=>'required|numeric|min:1|max:1000000');

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/
    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), self::$SESSION_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Model Routines
     * ---------------------------------------------------------------------*/

    public function calculatePayoff(Subject $subject)
    {
        $willingnessPayEntries = $subject->willingnessPayEntries;
        /* @var $willingnessPayEntry \SportExperiment\Repository\Eloquent\Subject\WillingnessPay */
        $willingnessPayEntry = $willingnessPayEntries[rand(0, count($willingnessPayEntries)-1)];

        $endowment = $subject->session->willingnessPay->getEndowment();

        // Generate a random number between 0 and the endowment
        $randomGoodPrice = lcg_value()*$endowment;

        if ($randomGoodPrice <= $willingnessPayEntry->getWillingnessPay()) {
            return array(SubjectWillingnessPay::$ITEM_PURCHASED_KEY=>true, SubjectWillingnessPay::$PAYOFF_KEY=>($endowment - $randomGoodPrice));
        }

        return array(SubjectWillingnessPay::$ITEM_PURCHASED_KEY=>false, SubjectWillingnessPay::$PAYOFF_KEY=>$endowment);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/
    /**
     * @return mixed
     */
    public function getEndowment()
    {
        return $this->getAttribute(self::$ENDOWMENT_KEY);
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->getAttribute(self::$SESSION_ID_KEY);
    }

}