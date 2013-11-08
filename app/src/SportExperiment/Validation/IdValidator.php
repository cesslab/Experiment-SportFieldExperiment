<?php namespace SportExperiment\Validation;

class IdValidator extends BaseValidator
{
    private static $ID_KEY = 'id';

    public function __construct($min = 1, $max = null)
    {
        $rules = array(self::$ID_KEY=>array('required', 'integer'));
        if (is_integer($min))
            $rules[] = sprintf("min:%s", $min);
        if ($max !== null && is_integer($max))
            $rules[] = sprintf("max:%s", $max);

        parent::__construct($rules);
    }

    public function setId($id)
    {
        $this->setData(array(self::$ID_KEY=>$id));
    }

    public function getId()
    {
        $data = $this->getData();
        if (isset($data[self::$ID_KEY]))
            return $data[self::$ID_KEY];

        return null;
    }

    public static function getKey()
    {
        return self::$ID_KEY;
    }
}