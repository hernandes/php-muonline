<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Item;
use MuOnline\Item\Luck;
use MuOnline\Item\Serial;
use MuOnline\Item\Skill;

class Season6 extends AbstractParser
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