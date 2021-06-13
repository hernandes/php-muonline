<?php
namespace MuOnline\Util;

trait BoolValueTrait
{

    private bool $value;

    public function set(bool $value = false): self
    {
        $this->value = $value;

        return $this;
    }

    public function has(): bool
    {
        return $this->value ?? false;
    }

    public function add(): self
    {
        $this->set(true);

        return $this;
    }

}