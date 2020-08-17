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

    /**
     * @param $position
     * @param Slot $slot
     * @return $this
     */
    public function add($position, Slot $slot) : self
    {
        $this->slots[$position] = $slot;

        return $this;
    }

    /**
     * @param Bonus $bonus
     * @return $this
     */
    public function setBonus(Bonus $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * @return Bonus
     */
    public function getBonus(): Bonus
    {
        if (! $this->bonus) {
            $this->setBonus(new Bonus());
        }

        return $this->bonus;
    }

}