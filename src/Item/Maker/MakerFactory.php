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
        $class = Team::current()->getClassFor('MuOnline\\Item\\Maker\\');

        return new $class;
    }

}