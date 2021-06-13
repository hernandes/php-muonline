<?php
namespace MuOnline\Util;

trait StringValueTrait
{

    private ?string $value;

    public function set(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function get(): ?string
    {
        return $this->value;
    }

}