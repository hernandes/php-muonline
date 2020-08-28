<?php
namespace MuOnline\Item;

class Ancient
{
    use ItemValueTrait;

    const STAMINA_5 = 5;
    const STAMINA_10 = 10;

    /**
     * @var int|null
     */
    private $type;

    /**
     * @var int|null
     */
    private $stamina;

    /**
     * Ancient constructor.
     * @param int|null $type
     * @param int|null $stamina
     */
    public function __construct(?int $type = null, ?int $stamina = null)
    {
        $this->type = $type;
        $this->stamina = $stamina;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
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
    public function getStamina()
    {
        return $this->stamina;
    }

    /**
     * @param int $type
     * @param int $stamina
     * @return $this
     */
    public function add(int $type, int $stamina = self::STAMINA_5): self
    {
        $this->setType($type);
        $this->setStamina($stamina);

        return $this;
    }

    /**
     * @param string $hex
     * @return $this
     */
    public function parse(string $hex): self
    {
        $this->type = 2;
        $this->stamina = 5;

        return $this;
    }
}