<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Parser;

class ParserFactory
{

    /**
     * @param string|null $hex
     * @return Parser
     */
    public static function factory(string $hex = null): Parser
    {
        return new Season0($hex);
    }

}