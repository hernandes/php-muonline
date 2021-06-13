<?php
namespace MuOnline\Item\Excellent;

use MuOnline\Util\BoolValueTrait;

class Slot
{
    use BoolValueTrait;

    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

}