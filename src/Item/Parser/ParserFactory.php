<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Parser;
use MuOnline\Team\Team;

class ParserFactory
{

    public static function factory(string $hex = null): Parser
    {
        $class = Team::current()->getClassFor('MuOnline\\Item\\Parser\\');

        return new $class($hex);
    }

}