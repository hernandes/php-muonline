<?php

namespace MuOnline\Item;

use MuOnline\Item\Excellent\Slot;

class Excellent
{
    use ItemSetTrait;

    /**
     * @var array<Slot>
     */
    private $slots = [];


    public function add($position, Slot $slot) : self
    {
        $this->slots[$position] = $slot;

        return $this;
    }
}