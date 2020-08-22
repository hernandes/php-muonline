<?php
namespace MuOnline\Item\Mastery;

class Slot
{

    /**
     * @var bool
     */
    private $value;

    /**
     * Slot constructor.
     * @param bool $value
     */
    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

    /**
     * @param bool $value
     * @return Slot
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
        $this->value = true;

        return $this;
    }

}