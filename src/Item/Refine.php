<?php
namespace MuOnline\Item;

use MuOnline\Util\BoolValueTrait;

class Refine
{
    use BoolValueTrait;

    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

}