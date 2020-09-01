<?php
namespace MuOnline\Item\Mastery;

use MuOnline\Item\IntValueTrait;

class Bonus
{

    use IntValueTrait;

    public function __construct(?int $value = null)
    {
        $this->value = $value;
    }

}