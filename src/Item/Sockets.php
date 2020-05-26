<?php
namespace MuOnline\Item;

use MuOnline\Item\Sockets\Bonus;
use MuOnline\Item\Sockets\Slot;

class Sockets
{

    use ItemSetTrait;

    /**
     * @var array<Slot>
     */
    private $slots = [];

    /**
     * @var Bonus
     */
    private $bonus;

    public function add($position, Slot $slot) : self
    {
        $this->slots[$position] = $slot;

        return $this;
    }

}