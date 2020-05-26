<?php
namespace MuOnline\Item;

class Serial
{

    use ItemSetTrait;

    private $value;

    /**
     * @param string $value
     * @return $this
     */
    public function set(string $value) : self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function get() : string
    {
        return $this->serial;
    }

    /**
     * @return string
     */
    public function generate() : string
    {
        $serial = rand(100001, 999999);

        $this->set($serial);

        return $serial;
    }

}