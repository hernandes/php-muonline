<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Item;
use MuOnline\Item\Parser;

abstract class AbstractParser implements Parser
{
    /**
     * @var string
     */
    private $hex;

    public function __construct($hex)
    {
        $this->hex = $hex;
    }

    /**
     * @param string $hex
     * @return $this
     */
    public function setHex(string $hex): self
    {
        $this->hex = $hex;

        return $this;
    }

    /**
     * @return string
     */
    public function getHex(): string
    {
        return $this->hex;
    }

    public function parse(Item $item)
    {
        throw new \BadMethodCallException('Method parse not implemented yet!');
    }
}
