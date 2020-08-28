<?php
namespace MuOnline\Item\Excellent;

use MuOnline\Item\BoolValueTrait;

class Slot
{

    use BoolValueTrait;

    /**
     * Slot constructor.
     * @param bool $value
     */
    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

}