<?php
namespace MuOnline\Item;

use MuOnline\Util\ItemValueTrait;

class Ancient
{
    use ItemValueTrait;

    const STAMINA_5 = 5;
    const STAMINA_10 = 10;

    private ?int $tier;
    private ?int $stamina;

    public function __construct(?int $tier = null, ?int $stamina = null)
    {
        $this->tier = $tier;
        $this->stamina = $stamina;
    }

    public function setTier(int $tier): self
    {
        $this->tier = $tier;

        return $this;
    }

    public function getTier(): int
    {
        return $this->tier;
    }

    public function setStamina(int $stamina): self
    {
        $this->stamina = $stamina;

        return $this;
    }

    public function getStamina(): ?int
    {
        return $this->stamina;
    }

    public function add(int $tier, int $stamina = self::STAMINA_5): self
    {
        $this->setTier($tier);
        $this->setStamina($stamina);

        return $this;
    }

    public function parse(string $hex): self
    {
        $this->tier = 2;
        $this->stamina = 5;

        return $this;
    }

    public function get(): int
    {
        return 0;
    }

}