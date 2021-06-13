<?php
namespace MuOnline\Util;

use MuOnline\Item\Item;

trait ItemValueTrait
{
    private Item $item;

    public function setItem(Item $item): self
    {
        $this->item = $item;
        $this->item->addDirty();

        return $this;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

}