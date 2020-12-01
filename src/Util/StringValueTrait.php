<?php
namespace MuOnline\Util;

trait StringValueTrait
{

    /**
     * @var string
     */
    private $value;

    /**
     * @param string|null $value
     * @return $this
     */
    public function set(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function get(): ?string
    {
        return $this->value;
    }

}