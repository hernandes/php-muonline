<?php
namespace MuOnline\Item;

trait ItemSetTrait
{

    private $item;

    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

}