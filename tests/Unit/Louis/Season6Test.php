<?php

use MuOnline\Team\Team;
use MuOnline\Item\Item;

test('louis season 6 test parse and make hex', function () {

    $team = Team::factory('louis', 6);
    Team::set($team);

    $hexes = [
        '786FFF00275EF5FF00FF'
    ];

    foreach ($hexes as $hex) {
        $item = new Item();
        $item->parse($hex);

        $this->assertEquals($hex, $item->make());
    }

});