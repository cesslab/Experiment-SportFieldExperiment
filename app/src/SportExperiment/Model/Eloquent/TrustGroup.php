<?php namespace SportExperiment\Model\Eloquent;


class TrustGroup extends TreatmentGroup
{
    public static $TABLE_KEY = 'trust_group';
    protected $table;

    public function __construct()
    {
        $this->table = self::$TABLE_KEY;
    }

    /**
     * @return bool
     */
    public function isProposer()
    {
        return $this->getSubjectRole() == TrustTreatment::getProposerRoleId();
    }

    /**
     * @return bool
     */
    public function isReceiver()
    {
        return $this->getSubjectRole() == TrustTreatment::getReceiverRoleId();
    }
}