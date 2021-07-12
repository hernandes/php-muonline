<?php
namespace MuOnline\Item;

use MuOnline\Util\IntValueTrait;
use MuOnline\Util\ItemValueTrait;

class Time
{
    use IntValueTrait,
        ItemValueTrait;

    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

    public function has(): bool
    {
        return false;
    }

}