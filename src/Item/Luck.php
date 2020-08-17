<?php
namespace MuOnline\Item;

class Luck
{
    use ItemSetTrait;

    /**
     * @var bool
     */
    private $value;

    /**
     * Luck constructor.
     * @param bool $value
     */
    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

    /**
     * @param bool $value
     * @return Luck
     */
    public function set(bool $value = false): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function has(): bool
    {
        return $this->value;
    }

    /**
     * @return $this
     */
    public function add(): self
    {
        $this->set(true);

        return $this;
    }

}