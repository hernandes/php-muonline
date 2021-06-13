<?php
namespace MuOnline\Item\Maker;

use MuOnline\Item\Item;
use MuOnline\Item\Maker;

abstract class AbstractMaker implements Maker
{

    public function make(Item $item): string
    {
        throw new \BadMethodCallException('Method make not implemented yet!');
    }

    protected function pad($string, $size = 2): string
    {
        return str_pad($string, $size, 0, STR_PAD_LEFT);
    }

}