<?php
namespace MuOnline\Item;

use MuOnline\Util\ItemValueTrait;

class Time
{

    use ItemValueTrait;

    /**
     * @var int
     */
    private $value;

    /**
     * Time constructor.
     * @param int $value
     */
    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function set(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function get(): ?int
    {
        return $this->value;
    }

}