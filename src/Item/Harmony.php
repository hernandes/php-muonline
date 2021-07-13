<?php
namespace MuOnline\Item;

use MuOnline\Util\ItemValueTrait;

class Harmony
{
    use ItemValueTrait;

    private ?int $type;
    private ?int $level;

    public function __construct(?int $type = null, ?int $level = null)
    {
        $this->type = $type;
        $this->level = $level;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function add(int $type = null, int $level = null): self
    {
        $this->setType($type);
        $this->setLevel($level);

        return $this;
    }

    public function parse(string $hex): self
    {
        $type = (int) hexdec(substr($hex, 0, 1));
        $level = (int) hexdec(substr($hex, 1));

        $this->type = $type;
        $this->level = $level;

        return $this;
    }

    public function has(): bool
    {
        return ! in_array($this->getType(), [0, 15]);
    }

}