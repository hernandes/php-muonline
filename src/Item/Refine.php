<?php
namespace MuOnline\Item;

class Refine
{
    use ItemValueTrait,
        BoolValueTrait;

    /**
     * Refine constructor.
     * @param bool $value
     */
    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

}