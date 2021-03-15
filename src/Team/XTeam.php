<?php
namespace MuOnline\Team;

class XTeam extends AbstractTeam
{

    /**
     * @var string
     */
    protected $name = 'XTeam';

    /**
     * @var array
     */
    protected $seasons = [
        Season::SEASON_0,
        Season::SEASON_2,
        Season::SEASON_4,
        Season::SEASON_6,
        Season::SEASON_8,
        Season::SEASON_10,
        Season::SEASON_12,
        Season::SEASON_13,
        Season::SEASON_14,
        Season::SEASON_15
    ];

}