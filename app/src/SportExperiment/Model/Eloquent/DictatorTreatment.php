<?php
/**
 * Created by PhpStorm.
 * User: aruff
 * Date: 11/27/13
 * Time: 3:01 PM
 */

namespace SportExperiment\Model\Eloquent;


class DictatorTreatment extends BaseEloquent implements GroupTreatmentInterface
{
    public static $TABLE_KEY = 'trust_treatments';

    public static $ID_KEY = 'id';
    public static $SESSION_ID_KEY = 'session_id';
    public static $PROPOSER_ALLOCATION_MULTIPLIER_KEY = 'sender_multiplier';
    public static $RECEIVER_ALLOCATION_MULTIPLIER_KEY = 'receiver_multiplier';

    private static $TASK_ID = 5;

    private static $PROPOSER_ROLE_ID = 1;
    private static $RECEIVER_ROLE_ID = 2;

    public $timestamps = false;

    protected $table;
    protected $fillable;
    protected $rules;

} 