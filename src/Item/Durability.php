<?php
namespace MuOnline\Item;

class Durability
{

    use ItemSetTrait;

    /**
     * @var int
     */
    private $value;

    /**
     * Durability constructor.
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

    public function repair()
    {

    }

}