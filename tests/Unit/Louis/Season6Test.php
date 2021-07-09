<?php

use MuOnline\Team\Team;
use MuOnline\Item\Item;

it('louis season 6 test parse and make hex', function () {

    $team = Team::factory('louis', 6);
    Team::set($team);

    $hexes = [
        '004A14000000AA00000000FFFFFFFFFF',
        '12d567000000787f000000ffffffffff',
        '1f8d6d000000613f000000bd04ffffff',
        '05FF31000000757F00406DFFFFFFFFFF'
    ];

    foreach ($hexes as $hex) {
        $item = new Item();
        $item->parse($hex);

        expect($hex)->toBe($item->make());
    }

});