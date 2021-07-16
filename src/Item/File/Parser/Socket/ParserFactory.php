<?php
namespace MuOnline\Item\File\Parser\Socket;

use MuOnline\Item\File\Parser\Item;
use MuOnline\Team\Team;

class ParserFactory
{

    public static function factory(): Item
    {
        $class = Team::current()->getClassFor('MuOnline\\Item\\File\\Parser\\Socket\\');

        return new $class;
    }

}