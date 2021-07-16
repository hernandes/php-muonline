<?php
namespace MuOnline\Item\File\Parser\Socket;

use MuOnline\Team\Team;

class ParserFactory
{

    public static function factory(): AbstractParser
    {
        $class = Team::current()->getClassFor('MuOnline\\Item\\File\\Parser\\Socket\\');

        return new $class;
    }

}