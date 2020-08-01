<?php
namespace MuOnline\Item;

use MuOnline\Item\Socket\Bonus;
use MuOnline\Item\Socket\Slot;

class Socket
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