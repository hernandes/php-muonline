<?php
namespace MuOnline\Item\Parser\IGCN;

use MuOnline\Item\Item;
use MuOnline\Item\Parser\AbstractParser;

class Season16 extends AbstractParser
{

    public function parse(Item $item): void
    {
        $hex = $this->getHex();
        $item->setHex($hex);

        $item->setDirty(false);
    }

}