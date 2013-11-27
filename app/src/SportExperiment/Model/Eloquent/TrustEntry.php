<?php namespace SportExperiment\Model\Eloquent;

use Illuminate\Support\Facades\Log;

class TrustEntry extends TaskEntry
{
    public static $TABLE_KEY = 'trust_entries';

    protected $table;
    protected $rules = [];
    protected $fillable = [];

    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trustReceiverEntries()
    {
        return $this->hasMany(TrustReceiverEntry::getNamespace(), TrustReceiverEntry::$TRUST_ENTRY_ID_KEY);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trustProposerEntries()
    {
        return $this->hasOne(TrustProposerEntry::getNamespace(), TrustProposerEntry::$TRUST_ENTRY_ID_KEY);
    }

    /**
     * @return TrustProposerEntry
     */
    public function getProposerEntry()
    {
        return $this->trustProposerEntries;
    }

    /**
     * @return TrustReceiverEntry[]
     */
    public function getReceiverEntries()
    {
        return $this->trustReceiverEntries;
    }

    /**
     * @param TrustProposerEntry
     * @param TrustTreatment
     * @return TrustReceiverEntry
     */
    public function getReceiverAllocationEntry(TrustProposerEntry $proposerEntry, TrustTreatment $trustTreatment)
    {
        $receiverEntries = $this->getReceiverEntries();
        $receiverMultiplier = $trustTreatment->getReceiverAllocationMultiplier();
        foreach ($receiverEntries as $receiverEntry) {
            if (($proposerEntry->getAllocation() * $receiverMultiplier) == $receiverEntry->getProposerAllocation())
                return $receiverEntry;
        }
        Log::error('Failed to find a receiver entry for the proposers allocation.');
    }
}