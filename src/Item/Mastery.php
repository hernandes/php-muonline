<?php
namespace MuOnline\Item;

use MuOnline\Item\Mastery\Bonus;

class Mastery
{

    use ItemSetTrait;

    /**
     * @var Bonus
     */
    private $bonus;

    /**
     * @param Bonus $bonus
     * @return $this
     */
    public function setBonus(Bonus $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * @return Bonus
     */
    public function getBonus(): Bonus
    {
        if (! $this->bonus) {
            $this->setBonus(new Bonus());
        }

        return $this->bonus;
    }

}