<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Item;

class DefaultParser extends AbstractParser
{

    public function parse(Item $item)
    {
        $item->setSection(2);
    }
}