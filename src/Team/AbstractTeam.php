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
     * @var int
     */
    protected $season = Season::SEASON_0;

    /**
     * AbstractTeam constructor.
     * @param int|null $season
     */
    public function __construct(?int $season = null)
    {
        if ($season) {
            $this->setSeason($season);
        }
    }

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

    /**
     * @param int $season
     * @return $this
     */
    public function setSeason(int $season): self
    {
        if (! in_array($season, $this->getSupportedSeasons())) {
            throw new \RuntimeException('Season not supported for this team');
        }

        $this->season = $season;

        return $this;
    }

    /**
     * @param int $season
     * @return $this
     */
    public function season(int $season): self
    {
        return $this->setSeason($season);
    }

    /**
     * @return int
     */
    public function getSeason(): int
    {
        return $this->season;
    }

    /**
     * @return string
     */
    public function getSeasonClass(): string
    {
        $season = $this->getSeason();

        return 'Season' . $season;
    }

    /**
     * @param $namespace
     * @return string
     */
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
            throw new \BadMethodCallException('Class for season ' . $season . ' of team ' . $this->getName() . ' not implemented yet!');
        }

        return $class;
    }

    /**
     * @return string
     */
    public function getItemFileName(): string
    {
        return 'Item.txt';
    }
}