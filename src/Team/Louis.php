<?php
namespace MuOnline\Team;

class Louis extends AbstractTeam
{

    /**
     * @var string
     */
    protected $name = 'Louis';

    /**
     * @var array
     */
    protected $seasons = [
        Season::SEASON_4,
        Season::SEASON_6,
        Season::SEASON_8
    ];

}