<?php namespace SportExperiment\Repository\Eloquent\Treatment;

use SportExperiment\Repository\Eloquent\BaseEloquent;
use SportExperiment\Repository\Eloquent\Session;

class WillingnessPay extends BaseEloquent
{
    public static $TABLE_KEY = 'willingness_to_pay_treatment';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $ENDOWMENT_KEY = 'endowment';

    protected $table;
    protected $fillable;
    protected $rules;

    public function __construct($attributes = array()){
        $this->table = self::$TABLE_KEY;
        $this->fillable = array(self::$SESSION_ID_KEY, self::$ENDOWMENT_KEY);
        $this->rules = array(self::$ENDOWMENT_KEY=>'required|integer|min:1|max:1000000');

        parent::__construct($attributes);
    }

    public function session()
    {
        return $this->belongsTo(Session::getNamespace(), self::$SESSION_ID_KEY);
    }

    /**
     * @return mixed
     */
    public function getEndowment()
    {
        return $this->getAttributes(self::$ENDOWMENT_KEY);
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->getAttributes(self::$SESSION_ID_KEY);
    }

}