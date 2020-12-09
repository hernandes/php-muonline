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
        $team = Team::getCurrent();
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