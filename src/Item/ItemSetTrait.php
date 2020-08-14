<?php
namespace MuOnline\Item;

trait ItemSetTrait
{

    /**
     * @var Item
     */
    private $item;

    /**
     * @param Item $item
     * @return $this
     */
    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

}