<?php
namespace MuOnline\Item\Socket;

use MuOnline\Team\Team;
use MuOnline\Util\IntValueTrait;

class Slot
{
    use IntValueTrait;

    private ?int $type;
    private ?int $level;

    public function __construct(?int $type = null, ?int $level = null)
    {
        $this->type = $type;
        $this->level = $level;
    }

    public function setType(int $type) : self
    {
        $this->type = $type;

        return $this;
    }

    public function getType() : int
    {
        return $this->type;
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

    public function add(?int $type = null, ?int $level = null): self
    {
        $this->type = $type;
        $this->level = $level;

        return $this;
    }

    public function parse(string $hex): self
    {
        $value = hexdec($hex);
        if ($value === -2) {
            $value = Team::current()->getSocketNoValue();
        } else if ($value === -1) {
            $value = Team::current()->getSocketEmptyValue();
        }

        $this->set($value);

        if (! in_array($value, [$this->getNoValue(), $this->getEmptyValue()])) {
            $type = $value % 50;
            $this->type = $type;
            $this->level = ($value - $type) / 50;
        }

        return $this;
    }

    public function has(): bool
    {
        return $this->get() !== $this->getNoValue();
    }

    public function getNoValue(): int
    {
        return Team::current()->getSocketNoValue();
    }

    public function getEmptyValue(): int
    {
        return Team::current()->getSocketEmptyValue();
    }

}