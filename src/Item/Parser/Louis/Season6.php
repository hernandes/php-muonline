<?php
namespace MuOnline\Item\Parser\Louis;

use MuOnline\Item\Item;
use MuOnline\Item\Parser\AbstractParser;

class Season6 extends AbstractParser
{

    /**
     * @param Item $item
     * @return void
     */
    public function parse(Item $item)
    {
        $hex = $this->getHex();
        $item->hex($hex);

        $item->index(0);
        $item->section(0);

        $item->setDirty(false);
    }

}