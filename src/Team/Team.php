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
    public static function setCurrent(AbstractTeam $team)
    {
        static::$current = $team;
    }

    /**
     * @return AbstractTeam
     */
    public static function getCurrent(): AbstractTeam
    {
        return static::$current;
    }

}