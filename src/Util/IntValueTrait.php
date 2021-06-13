<?php
namespace MuOnline\Util;

trait IntValueTrait
{

    private ?int $value;

    public function set(?int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function get(): ?int
    {
        return $this->value;
    }

}