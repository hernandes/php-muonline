<?php
namespace MuOnline\Item\Excellent;

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
     * @param bool $value
     * @return Slot
     */
    public function add(bool $value = true): self
    {
        $this->value = $value;

        return $this;
    }

}