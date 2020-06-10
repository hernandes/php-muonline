<?php
namespace MuOnline\Item;

interface Maker
{

    /**
     * @param Item $item
     * @return string
     */
    public function make(Item $item): string;

}