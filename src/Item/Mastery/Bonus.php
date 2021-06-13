<?php
namespace MuOnline\Item\Mastery;

use MuOnline\Util\IntValueTrait;

class Bonus
{
    use IntValueTrait;

    public function __construct(?int $value = null)
    {
        $this->value = $value;
    }

}