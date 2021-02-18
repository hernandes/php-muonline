<?php
namespace MuOnline\Item\File\Parser\Item;

use MuOnline\Team\Team;

class ParserFactory
{

    public static function factory()
    {
        $base = 'MuOnline\\Item\\File\\Parser\\Item\\';
        $team = Team::current();
        $class = $base . $team->getName() . '\\' . $team->getSeasonClass();

        if (! class_exists($class)) {
            $class = $base . $team->getSeasonClass();

            if (! class_exists($class)) {
                $class = null;
            }
        }

        if (! $class) {
            throw new \BadMethodCallException('Class for season ' . $team->getSeasonClass() . ' of team ' . $team->getName() . ' not implemented yet!');
        }

        return new $class;
    }

}