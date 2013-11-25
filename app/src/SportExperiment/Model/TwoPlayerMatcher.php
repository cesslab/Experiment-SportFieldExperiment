<?php namespace SportExperiment\Model;

class TwoPlayerMatcher
{
    public static $GROUP_SIZE = 2;

    /**
     * @param Eloquent\Subject[] $subjects
     * @param int $roleAType
     * @param int $roleBType
     *
     * @return Group[]
     */
    public static function matchSubjects(array $subjects, $roleAType, $roleBType)
    {
        shuffle($subjects);
        $groups = [];
        for ($i = 0, $j = 1, $k = 0; $k < count($subjects); $k += self::$GROUP_SIZE) {
            $i = ( ! isset($subjects[$i])) ? 0 : $i;
            $j = ( ! isset($subjects[$j])) ? 1 : $j;
            $group = new Group();
            $group->setSubject($subjects[$i], $roleAType);
            $group->setSubject($subjects[$j], $roleBType);
            $groups[] = $group;
            $i += self::$GROUP_SIZE;
            $j += self::$GROUP_SIZE;
        }

        return $groups;
    }
}