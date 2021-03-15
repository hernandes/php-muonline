<?php
namespace MuOnline\Item\File\Parser\Item;

use MuOnline\Team\Team;

class ParserFactory
{

    public static function factory()
    {
        $base = 'MuOnline\\Item\\File\\Parser\\Item\\';
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

        return new $class;
    }

}