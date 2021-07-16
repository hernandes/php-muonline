<?php
namespace MuOnline\Team;

class IGCN extends AbstractTeam
{

    protected string $name = 'IGCN';
    protected array $seasons = [
        Season::SEASON_6,
        Season::SEASON_16
    ];
    protected array $files = [
        'items' => 'ItemList.xml'
    ];

}