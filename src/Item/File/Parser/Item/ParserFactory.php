<?php
namespace MuOnline\Item\File\Parser\Item;

use MuOnline\Team\Team;

class ParserFactory
{

    public static function factory(): AbstractParser
    {
        $class = Team::current()->getClassFor('MuOnline\\Item\\File\\Parser\\Item\\');

        return new $class;
    }

}