<?php
namespace MuOnline\Item\Maker;

use MuOnline\Item\Item;
use MuOnline\Item\Maker;

class Season0 implements Maker
{

    /**
     * @param Item $item
     * @return string
     */
    public function make(Item $item): string
    {
        return 'abc';
    }
}