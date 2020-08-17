<?php
namespace MuOnline\Item;

class Skill
{
    use ItemSetTrait;

    /**
     * @var bool
     */
    private $value = false;

    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

    /**
     * @param bool $value
     * @return Skill
     */
    public function set(bool $value = false): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function has(): bool
    {
        return $this->value;
    }

    /**
     * @return $this
     */
    public function add(): self
    {
        $this->set(true);

        return $this;
    }

}