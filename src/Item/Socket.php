<?php
namespace MuOnline\Item;

use MuOnline\Item\Socket\Bonus;
use MuOnline\Item\Socket\Slot;

class Socket
{

    use ItemValueTrait;

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
     * @param int $index
     * @return Slot
     */
    public function getSlot(int $index): Slot
    {
        $slot = $this->slots[$index] ?? null;
        if (! $slot) {
            $slot = new Slot(255);
            $this->add($index, $slot);
        }

        return $slot;
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