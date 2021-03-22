<?php
namespace MuOnline\Item\File\Parser\Item;

use MuOnline\Item\File\Parser\Item;
use MuOnline\Team\Team;

class ParserFactory
{

    /**
     * @return Item
     */
    public static function factory(): Item
    {
        $class = Team::current()->getClassFor('MuOnline\\Item\\File\\Parser\\Item\\');

        return new $class;
    }

}