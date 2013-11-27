<?php namespace SportExperiment\Model\Eloquent;


class TreatmentGroup extends BaseEloquent
{
    public $timestamps = false;

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $SUBJECT_ROLE_KEY = 'subject_role_id';
    public static $PARTNER_SUBJECT_ID_KEY = 'partner_subject_id';
    public static $PARTNER_ROLE_KEY = 'partner_role';

    /**
     *
     */
    public function __construct()
    {
        parent::__construct([]);
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
     * Model Business Logic
     * ---------------------------------------------------------------------*/

    /**
     * @param string|int $role
     * @return bool
     */
    public function isSubjectRole($role)
    {
        return $this->getSubjectRole() == $role;
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    /**
     * @return Subject
     */
    public function getPartner()
    {
        $partnerId = $this->getPartnerId();
        return Subject::find($partnerId);
    }

    /**
     * @return int
     */
    public function getSubjectRole()
    {
        return $this->getAttribute(self::$SUBJECT_ROLE_KEY);
    }

    /**
     * @return mixed
     */
    public function getPartnerId()
    {
        return $this->getAttribute(self::$PARTNER_SUBJECT_ID_KEY);
    }

    /**
     * @return mixed
     */
    public function getPartnerRole()
    {
        return $this->getAttribute(self::$PARTNER_ROLE_KEY);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getAttribute(self::$ID_KEY);
    }

    /**
     * @param int $subjectId
     */
    public function setSubjectId($subjectId)
    {
        $this->setAttribute(self::$SUBJECT_ID_KEY, $subjectId);
    }

    /**
     * @param int $role
     */
    public function setSubjectRole($role)
    {
        $this->setAttribute(self::$SUBJECT_ROLE_KEY, $role);
    }

    /**
     * @param $role
     */
    public function setPartnerRole($role)
    {
        $this->setAttribute(self::$PARTNER_ROLE_KEY, $role);
    }

    /**
     * @param int $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->setAttribute(self::$PARTNER_SUBJECT_ID_KEY, $partnerId);
    }


} 