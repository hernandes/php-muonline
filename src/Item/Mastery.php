<?php
namespace MuOnline\Item;

use MuOnline\Item\Mastery\Bonus;
use MuOnline\Item\Mastery\Slot;
use MuOnline\Util\ItemValueTrait;

class Mastery
{
    use ItemValueTrait;

    private array $slots = [];
    private Bonus $bonus;

    public function __construct()
    {
        $this->bonus = new Bonus();
    }

    public function add($position, $slot): self
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

    public function setBonus(Bonus $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    public function getBonus(): Bonus
    {
        if (! $this->bonus) {
            $this->setBonus(new Bonus());
        }

        return $this->bonus;
    }

}