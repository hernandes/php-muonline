<?php
namespace MuOnline\Item;

class Harmony
{

    use ItemValueTrait;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $level;

    /**
     * Harmony constructor.
     * @param int|null $type
     * @param int|null $level
     */
    public function __construct(int $type = null, int $level = null)
    {
        $this->type = $type;
        $this->level = $level;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $level
     * @return $this
     */
    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int|null $type
     * @param int|null $level
     * @return $this
     */
    public function add(?int $type = null, ?int $level = null): self
    {
        $this->setType($type);
        $this->setLevel($level);

        return $this;
    }

}