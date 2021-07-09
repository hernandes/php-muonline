<?php
namespace MuOnline\Item;

use MuOnline\Util\ItemValueTrait;
use MuOnline\Util\StringValueTrait;

class Serial
{
    use StringValueTrait,
        ItemValueTrait;

    private ?string $value;

    public function __construct(?string $value = null)
    {
        $this->value = $value;
    }

    public function generate(): string
    {
        $serial = rand(100001, 999999);

        $this->set($serial);

        return $serial;
    }

}