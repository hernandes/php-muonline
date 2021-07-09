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
    public function parse(Item $item): void
    {
        $hex = $this->getHex();
        $item->setHex($hex);

        $item->setIndex(0);
        $item->setSection(0);

        $item->setDirty(false);
    }

}