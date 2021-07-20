<?php
namespace MuOnline\Util;

trait DirtyTrait
{
    private bool $dirty = false;

    public function setDirty(bool $dirty): self
    {
        $this->dirty = $dirty;

        return $this;
    }

    public function addDirty($old = null, $new = null): self
    {
        if ($old === null && $new === null) {
            $this->itsDirty();
        } else {
            $this->setDirty($old !== $new);
        }

        return $this;
    }

    public function isDirty(): bool
    {
        return $this->dirty;
    }

    public function itsDirty(): self
    {
        return $this->setDirty(true);
    }

    public function itsNotDirty(): self
    {
        return $this->setDirty(false);
    }

}