<?php
namespace MuOnline\Item\Excellent;

use MuOnline\Util\BoolValueTrait;

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