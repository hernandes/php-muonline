<?php
namespace MuOnline\Item;

use MuOnline\Util\BoolValueTrait;
use MuOnline\Util\ItemValueTrait;

class Refine
{

    use ItemValueTrait,
        BoolValueTrait;

    /**
     * Refine constructor.
     * @param bool $value
     */
    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

}