<?php
namespace MuOnline\Item;

use MuOnline\Util\IntValueTrait;
use MuOnline\Util\ItemValueTrait;

class Time
{

    use ItemValueTrait,
        IntValueTrait;

    /**
     * Time constructor.
     * @param int $value
     */
    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

}