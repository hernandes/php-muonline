<?php

namespace MuOnline\Item;

use MuOnline\Item\Excellent\Slot;

class Excellent
{
    use ItemValueTrait;

    /**
     * @var array<Slot>
     */
    private $slots = [];

    /**
     * @param $position
     * @param Slot $slot
     * @return $this
     */
    public function add($position, Slot $slot): self
    {
        $this->slots[$position] = $slot;

        return $this;
    }

    /**
     * @param $index
     * @return Slot
     */
    public function getSlot($index): Slot
    {
        $slot = $this->slots[$index] ?? null;
        if (! $slot) {
            $slot = new Slot(false);
            $this->add($index, $slot);
        }

        return $slot;
    }
}