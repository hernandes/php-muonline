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
        $this->add($value);
    }

    /**
     * @param bool $value
     * @return Skill
     */
    public function set(bool $value = false) : self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function has()
    {
        return $this->value;
    }

    /**
     * @param bool $value
     * @return Skill
     */
    public function add(bool $value = true) : self
    {
        $this->value = $value;

        return $this;
    }

}