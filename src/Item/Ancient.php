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

    private array $options = [
        4 => [2, 5],
        5 => [0, 5],
        6 => [1, 5],
        8 => [2, 10],
        9 => [0, 10],
        10 => [1, 10]
    ];

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

    public function getTier(): ?int
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
        $dec = hexdec($hex);

        if (isset($this->options[$dec])) {
            $option = $this->options[$dec];

            $this->tier = $option[0];
            $this->stamina = $option[1];
        }

        return $this;
    }

    public function get(): int
    {
        foreach ($this->options as $id => $option) {
            if ($option[0] === $this->tier && $option[1] === $this->stamina) {
                return $id;
            }
        }

        return 0;
    }

}