<?php namespace SportExperiment\Model;


class NFLTeams
{
    private static $NFL_TEAMS = [
        'AFC East'=> [
            1=>'Buffalo Bills', 'Miami Dolphins', 'New England Patriots', 'New York Jets'],
        'AFC North'=> [
            5=>'Baltimore Ravens', 'Cincinnati Bengals', 'Cleveland Browns', 'Pittsburgh Steelers'],
        'AFC South'=> [
            9=>'Houston Texans', 'Indianapolis Colts', 'Jacksonville Jaguars', 'Tennessee Titans'],
        'AFC West'=> [
            13=>'Denver Broncos', 'Kansas City Chiefs', 'Oakland Raiders', 'San Diego Chargers'],
        'NFC East'=> [
            17=>'Dallas Cowboys', 'New York Giants', 'Philadelphia Eagles', 'Washington Redskins'],
        'NFC North'=> [
            21=>'Chicago Bears', 'Detroit Lions', 'Green Bay Packers', 'Minnesota Vikings'],
        'NFC South'=> [
            25=>'Atlanta Falcons', 'Carolina Panthers', 'New Orleans Saints', 'Tampa Bay Buccaneers'],
        'NFC West' => [
            29=>'Arizona Cardinals', 'St. Louis Rams', 'San Francisco 49ers', 'Seattle Seahawks']
    ];

    public static function getTeam($teamId)
    {
        foreach (self::$NFL_TEAMS as $division) {
            if (isset($division[$teamId])) {
                return $division[$teamId];
            }
        }
    }

    public static function numTeams()
    {
        $numTeams = 0;
        foreach (self::$NFL_TEAMS as $divisions)
        {
            $numTeams = $numTeams + count($divisions);
        }

        return $numTeams;
    }

    public static function getNFLTeams()
    {
        return self::$NFL_TEAMS;
    }

} 