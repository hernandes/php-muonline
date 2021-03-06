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
        if ($season !== Season::SEASON_0) {
            $season = $season / 10;
        }

        return 'Season' . $season;
    }

    /**
     * @return string
     */
    public function getItemFileName(): string
    {
        return 'Item.txt';
    }
}