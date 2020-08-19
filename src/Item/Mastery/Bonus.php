<?php
namespace MuOnline\Item\Mastery;

class Bonus
{

    /**
     * @var int|null
     */
    private $value;

    public function __construct(?int $value = null)
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