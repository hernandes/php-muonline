<?php
namespace MuOnline\Item\Socket;

use MuOnline\Util\IntValueTrait;

class Bonus
{
    use IntValueTrait;

    public function __construct(?int $value = null)
    {
        $this->value = $value;
    }

}