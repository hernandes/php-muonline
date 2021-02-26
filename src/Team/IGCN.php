<?php
namespace MuOnline\Team;

class IGCN extends AbstractTeam
{

    /**
     * @var string
     */
    protected $name = 'IGCN';

    /**
     * @var array
     */
    protected $seasons = [
        Season::SEASON_6,
        Season::SEASON_16
    ];

    /**
     * @return string
     */
    public function getItemFileName(): string
    {
        return 'ItemList.xml';
    }

}