<?php
namespace MuOnline\Item\Maker;

use MuOnline\Item\Maker;
use MuOnline\Team\Team;

class MakerFactory
{

    /**
     * @return Maker
     */
    public static function factory(): Maker
    {
        $base = 'MuOnline\\Item\\Maker\\';
        $team = Team::current();
        $class = $base . $team->getName() . '\\' . $team->getSeasonClass();

        if (! class_exists($class)) {
            $class = $base . $team->getSeasonClass();

            if (! class_exists($class)) {
                $class = null;
            }
        }

        if (! $class) {
            throw new \BadMethodCallException('Class for season not implemented yet!');
        }

        return new $class;
    }

}