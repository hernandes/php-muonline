<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Item;

class DefaultParser extends AbstractParser
{

    /**
     * @param Item $item
     * @return mixed|void
     */
    public function parse(Item $item)
    {
        $hex = $this->getHex();

    }
}