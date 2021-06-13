<?php
namespace MuOnline\Team;

use ReflectionClass;
use RuntimeException;
use BadMethodCallException;

abstract class AbstractTeam
{

    protected string $name;
    protected array $seasons = [];
    protected int $season = Season::SEASON_0;

    public function __construct(?int $season = null)
    {
        if ($season) {
            $this->setSeason($season);
        }
    }

    public function getName(): string
    {
        if (! $this->name) {
            $this->name = (new ReflectionClass($this))->getShortName();
        }

        return $this->name;
    }

    public function getSupportedSeasons(): array
    {
        return $this->seasons;
    }

    public function setSeason(int $season): self
    {
        if (! in_array($season, $this->getSupportedSeasons())) {
            throw new RuntimeException('Season not supported for this team');
        }

        $this->season = $season;

        return $this;
    }

    public function season(int $season): self
    {
        return $this->setSeason($season);
    }

    public function getSeason(): int
    {
        return $this->season;
    }

    public function getSeasonClass(): string
    {
        $season = $this->getSeason();

        return 'Season' . $season;
    }

    public function getClassFor($namespace): string
    {
        $season = $this->getSeasonClass();
        $class = $namespace . $this->getName() . '\\' . $season;

        if (! class_exists($class)) {
            $class = $namespace . $season;

            if (! class_exists($class)) {
                $class = null;
            }
        }

        if (! $class) {
            throw new BadMethodCallException('Class for season ' . $season . ' of team ' . $this->getName() . ' not implemented yet!');
        }

        return $class;
    }

    public function getItemFileName(): string
    {
        return 'Item.txt';
    }
}