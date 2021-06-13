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

    /**
     * AbstractParser constructor.
     * @param null $hex
     */
    public function __construct($hex = null)
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
     * @return string|null
     */
    public function getHex(): ?string
    {
        return $this->hex;
    }

    /**
     * @param Item $item
     * @return mixed|void
     */
    public function parse(Item $item): void
    {
        throw new \BadMethodCallException('Method parse not implemented yet!');
    }

}
