<?php
namespace MuOnline\Team;

class MuEmu extends AbstractTeam
{

    /**
     * @var string
     */
    protected $name = 'MuEmu';

    /**
     * @var array
     */
    protected $seasons = [
        Season::SEASON_6,
        Season::SEASON_16
    ];

}