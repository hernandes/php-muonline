<?php
namespace MuOnline\Item;

class Skill
{

    use ItemValueTrait,
        BoolValueTrait;

    /**
     * Skill constructor.
     * @param bool $value
     */
    public function __construct(bool $value = false)
    {
        $this->value = $value;
    }

}