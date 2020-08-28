<?php
namespace MuOnline\Item;

use MuOnline\Item\Mastery\Bonus;
use MuOnline\Item\Mastery\Slot;

class Mastery
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