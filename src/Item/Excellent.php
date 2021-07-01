<?php

namespace MuOnline\Item;

use MuOnline\Item\Excellent\Slot;

class Excellent
{

    private array $slots = [];

    public function add(int $position, $slot): self
    {
        if (! $slot instanceof Slot) {
            $slot = new Slot($slot);
        }

        $this->slots[$position] = $slot;

        return $this;
    }

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