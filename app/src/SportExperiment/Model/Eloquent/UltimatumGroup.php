<?php namespace SportExperiment\Model\Eloquent;

class UltimatumGroup extends TreatmentGroup
{
    public static $TABLE_KEY = 'ultimatum_group';
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
        return $this->getSubjectRole() == UltimatumTreatment::getProposerRoleId();
    }

    /**
     * @return bool
     */
    public function isReceiver()
    {
        return $this->getSubjectRole() == UltimatumTreatment::getReceiverRoleId();
    }
}