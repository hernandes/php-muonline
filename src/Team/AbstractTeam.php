<?php
namespace MuOnline\Team;

abstract class AbstractTeam
{

    /**
     * @var string
     */
    protected $name = null;

    /**
     * @var array
     */
    protected $seasons = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        if (! $this->name) {
            try {
                $this->name = (new \ReflectionClass($this))->getShortName();
            } catch (\ReflectionException $ignore) {}
        }

        return $this->name;
    }

    /**
     * @return array
     */
    public function getSupportedSeasons(): array
    {
        return $this->seasons;
    }

}