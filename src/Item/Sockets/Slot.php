<?php
namespace MuOnline\Item\Sockets;

class Slot
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $level;

    public function __construct(?int $id = null, ?int $level = null)
    {
        $this->add($id, $level);
    }

    /**
     * @param int $id
     * @return Slot
     */
    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $level
     * @return Slot
     */
    public function setLevel(int $level) : self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int|null $id
     * @param int|null $level
     * @return Slot
     */
    public function add(?int $id = null, ?int $level = null)
    {
        $this->id = $id;
        $this->level = $level;

        return $this;
    }
}