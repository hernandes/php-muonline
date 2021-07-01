<?php
namespace MuOnline\Item;

class Harmony
{

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

    public function add(?int $type = null, ?int $level = null): self
    {
        $this->setType($type);
        $this->setLevel($level);

        return $this;
    }

}