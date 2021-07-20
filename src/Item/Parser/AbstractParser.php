<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Item;
use MuOnline\Item\Parser;
use BadMethodCallException;

abstract class AbstractParser implements Parser
{

    private ?string $hex;

    public function __construct(?string $hex = null)
    {
        $this->hex = $hex;
    }

    public function setHex(string $hex): self
    {
        $this->hex = $hex;

        return $this;
    }

    public function getHex(): ?string
    {
        return $this->hex;
    }

    public function parse(Item $item): void
    {
        throw new BadMethodCallException('Method parse not implemented yet!');
    }

}
