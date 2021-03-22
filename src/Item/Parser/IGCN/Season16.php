<?php
namespace MuOnline\Item\Parser\IGCN;

use MuOnline\Item\Item;
use MuOnline\Item\Parser\AbstractParser;

class Season16 extends AbstractParser
{

    /**
     * @param Item $item
     * @return void
     */
    public function parse(Item $item)
    {
        $hex = $this->getHex();
        $item->setHex($hex);

        $item->setDirty(false);
    }

}