<?php
namespace MuOnline\Item;

trait ItemValueTrait
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
        $this->item->addDirty();

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