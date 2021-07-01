<?php
namespace MuOnline\Item;

use MuOnline\Util\IntValueTrait;

class Time
{
    use IntValueTrait;

    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

}