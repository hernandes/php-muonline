<?php
namespace MuOnline\Item;

interface Parser
{

    /**
     * @param $item
     * @return mixed
     */
    public function parse(Item $item);

}