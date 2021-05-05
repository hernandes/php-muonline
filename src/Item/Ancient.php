<?php
namespace MuOnline\Item;

use MuOnline\Util\ItemValueTrait;

class Ancient
{
    use ItemValueTrait;

    const STAMINA_5 = 5;
    const STAMINA_10 = 10;

    /**
     * @var int|null
     */
    private $tier;

    /**
     * @var int|null
     */
    private $stamina;

    /**
     * Ancient constructor.
     * @param int|null $tier
     * @param int|null $stamina
     */
    public function __construct(?int $tier = null, ?int $stamina = null)
    {
        $this->tier = $tier;
        $this->stamina = $stamina;
    }

    /**
     * @param int $tier
     * @return $this
     */
    public function setTier(int $tier): self
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * @return int
     */
    public function getTier(): int
    {
        return $this->tier;
    }

    /**
     * @param int $stamina
     * @return $this
     */
    public function setStamina(int $stamina): self
    {
        $this->stamina = $stamina;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStamina(): ?int
    {
        return $this->stamina;
    }

    /**
     * @param int $tier
     * @param int $stamina
     * @return $this
     */
    public function add(int $tier, int $stamina = self::STAMINA_5): self
    {
        $this->setTier($tier);
        $this->setStamina($stamina);

        return $this;
    }

    /**
     * @param string $hex
     * @return $this
     */
    public function parse(string $hex): self
    {
        $this->tier = 2;
        $this->stamina = 5;

        return $this;
    }
}