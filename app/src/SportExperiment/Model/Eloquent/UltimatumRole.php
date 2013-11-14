<?php namespace SportExperiment\Model\Eloquent;

class UltimatumRole extends BaseEloquent
{
    public static $TABLE_KEY = 'ultimatum_role';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $PARTNER_SUBJECT_ID_KEY = 'partner_id';
    public static $ROLE_KEY = 'role';

    private static $PROPOSER = 1;
    private static $RECEIVER = 2;
    public static $NO_PARTNER_ID = -1;

    public $timestamps = false;

    protected $table;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = []){
        $this->table = self::$TABLE_KEY;

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
     * @return int
     */
    public function getRole()
    {
        return $this->getAttribute(self::$ROLE_KEY);
    }

    public function getPartnerId()
    {
        return $this->getAttribute(self::$PARTNER_SUBJECT_ID_KEY);
    }

    /**
     * @param int $role
     */
    public function setRole($role)
    {
        $this->setAttribute(self::$ROLE_KEY, $role);
    }

    /**
     * @param int $subjectId
     */
    public function setSubjectId($subjectId)
    {
        $this->setAttribute(self::$SUBJECT_ID_KEY, $subjectId);
    }

    /**
     * @param int $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->setAttribute(self::$PARTNER_SUBJECT_ID_KEY, $partnerId);
    }


    /**
     * @return int
     */
    public static function getProposerId()
    {
        return self::$PROPOSER;
    }

    /**
     * @return int
     */
    public static function getReceiverId()
    {
        return self::$RECEIVER;
    }

} 