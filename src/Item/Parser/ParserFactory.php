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
        $class = Team::current()->getClassFor('MuOnline\\Item\\Parser\\');

        return new $class($hex);
    }

}