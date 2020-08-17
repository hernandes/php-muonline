<?php
namespace MuOnline\Item\Maker;

use MuOnline\Item\Maker;

class MakerFactory
{

    /**
     * @return Maker
     */
    public static function factory(): Maker
    {
        return new Season0();
    }

}