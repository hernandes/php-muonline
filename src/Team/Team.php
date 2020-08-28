<?php
namespace MuOnline\Team;

class Team
{

    /**
     * @var array[]
     */
    private $available = [
        'gmo' => [
            'name' => '',
            'seasons' => [
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
            ]
        ],
        'igcn' => [
            'name' => '',
            'seasons' => [
                Season::SEASON_15
            ]
        ],
        'xteam' => [
            'name' => '',
            'seasons' => [
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
            ]
        ],
        'louis' => [
            'name' => '',
            'seasons' => [
                Season::SEASON_4,
                Season::SEASON_6,
                Season::SEASON_8
            ]
        ]
    ];

}