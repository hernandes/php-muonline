<?php
namespace MuOnline\Team;

class Team
{

    /**
     * @var AbstractTeam
     */
    private static $current;

    /**
     * @param AbstractTeam $team
     */
    public static function set(AbstractTeam $team)
    {
        static::$current = $team;
    }

    /**
     * @return AbstractTeam
     */
    public static function current(): AbstractTeam
    {
        return static::$current;
    }

}