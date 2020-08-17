<?php
namespace MuOnline\Item;

class Serial
{
    use ItemSetTrait;

    /**
     * @var string
     */
    private $value;

    /**
     * Serial constructor.
     * @param string|null $value
     */
    public function __construct(?string $value = null)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function set(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $serial = rand(100001, 999999);

        $this->set($serial);

        return $serial;
    }

}