<?php
namespace MuOnline\Item;

use MuOnline\Util\ItemValueTrait;
use MuOnline\Util\StringValueTrait;

class Serial
{

    use ItemValueTrait,
        StringValueTrait;

    /**
     * @var string
     */
    private $value;

    /**
     * Serial constructor.
     * @param string|null $value
     */
    public function __construct(?string $value = null)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $serial = rand(100001, 999999);

        $this->set($serial);

        return $serial;
    }

}