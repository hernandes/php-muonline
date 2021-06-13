<?php
namespace MuOnline\Item\Socket;

class Slot
{

    private ?int $id;
    private ?int $level;

    public function __construct(?int $id = null, ?int $level = null)
    {
        $this->id = $id;
        $this->level = $level;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setLevel(int $level) : self
    {
        $this->level = $level;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function add(?int $id = null, ?int $level = null): self
    {
        $this->id = $id;
        $this->level = $level;

        return $this;
    }

    public function parse($hex): self
    {
        $this->id = 0;
        $this->level = 0;

        return $this;
    }
}