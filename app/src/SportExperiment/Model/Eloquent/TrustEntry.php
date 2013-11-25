<?php namespace SportExperiment\Model\Eloquent;


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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trustProposerEntries()
    {
        return $this->hasMany(TrustProposerEntry::getNamespace(), TrustProposerEntry::$TRUST_ENTRY_ID_KEY);
    }
}