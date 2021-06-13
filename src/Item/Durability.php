<?php
namespace MuOnline\Item;

use MuOnline\Util\IntValueTrait;
use MuOnline\Util\ItemValueTrait;

class Durability
{
    use ItemValueTrait,
        IntValueTrait;

    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

    public function repair()
    {

    }

}