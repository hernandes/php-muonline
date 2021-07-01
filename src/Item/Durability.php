<?php
namespace MuOnline\Item;

use MuOnline\Util\IntValueTrait;

class Durability
{
    use IntValueTrait;

    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

    public function repair()
    {

    }

}