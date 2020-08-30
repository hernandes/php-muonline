<?php
namespace MuOnline\Item;

trait BoolValueTrait
{

    /**
     * @var bool
     */
    private $value;


    /**
     * @param bool $value
     * @return Refine
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