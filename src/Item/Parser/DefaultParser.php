<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Durability;
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


        $item->setSection(10);
        $item->setDurability(new Durability(255));
    }
}