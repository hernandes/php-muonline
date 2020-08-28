<?php
namespace MuOnline\Item;

class Luck
{
    use ItemValueTrait,
        BoolValueTrait;

    /**
     * Luck constructor.
     * @param bool $value
     */
    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }


}