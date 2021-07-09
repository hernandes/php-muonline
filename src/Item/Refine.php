<?php
namespace MuOnline\Item;

use MuOnline\Util\BoolValueTrait;
use MuOnline\Util\ItemValueTrait;

class Refine
{
    use BoolValueTrait,
        ItemValueTrait;

    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

}