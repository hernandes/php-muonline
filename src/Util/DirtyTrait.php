<?php
namespace MuOnline\Util;

trait DirtyTrait
{

    /**
     * @var bool;
     */
    private $dirty = false;


    /**
     * @param bool $dirty
     * @return $this
     */
    public function setDirty(bool $dirty): self
    {
        $this->dirty = $dirty;

        return $this;
    }

    /**
     * @param null $old
     * @param null $new
     * @return $this
     */
    public function addDirty($old = null, $new = null): self
    {
        $this->setDirty($old !== $new);

        return $this;
    }

    /**
     * @return bool
     */
    public function isDirty(): bool
    {
        return $this->dirty;
    }

}