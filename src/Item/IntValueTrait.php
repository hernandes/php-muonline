<?php
namespace MuOnline\Item;

trait IntValueTrait
{

    /**
     * @var int
     */
    private $value;

    /**
     * @param int|null $value
     * @return $this
     */
    public function set(?int $value): self
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