<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Parser;
use MuOnline\Team\Team;

class ParserFactory
{

    /**
     * @param string|null $hex
     * @return Parser
     */
    public static function factory(string $hex = null): Parser
    {
        $base = 'MuOnline\\Item\\Parser\\';
        $team = Team::current();
        $season = $team->getSeasonClass();
        $class = $base . $team->getName() . '\\' . $season;

        if (! class_exists($class)) {
            $class = $base . $team->getSeasonClass();

            if (! class_exists($class)) {
                $class = null;
            }
        }

        if (! $class) {
            throw new \BadMethodCallException('Class for season ' . $base . ' of team ' . $team->getName() . ' not implemented yet!');
        }

        return new $class($hex);
    }

}