<?php
namespace MuOnline\Item;

use MuOnline\Item\Socket\Bonus;
use MuOnline\Item\Socket\Slot;
use MuOnline\Team\Team;
use MuOnline\Util\ItemValueTrait;

class Socket
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

    public function getSlot(int $index): Slot
    {
        $slot = $this->slots[$index] ?? null;
        if (! $slot) {
            $slot = new Slot(255);
            $this->add($index, $slot);
        }

        return $slot;
    }

    public function exists(): bool
    {
        return $this->has();
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

    public function has(): bool
    {
        foreach ($this->slots as $slot) {
            if ($slot->has()) {
                return true;
            }
        }

        return false;
    }

    public function getNoValue(): int
    {
        return Team::current()->getSocketNoValue();
    }

    public function getEmptyValue(): int
    {
        return Team::current()->getSocketEmptyValue();
    }

}