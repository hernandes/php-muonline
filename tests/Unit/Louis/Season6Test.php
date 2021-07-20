<?php

use MuOnline\Team\Team;
use MuOnline\Item\Item;

$hexes = [
    '004A14000000AA00000000FFFFFFFFFF',
    '12d567000000787f000000ffffffffff',
    '1f8d6d000000613f000000bd04ffffff',
    '05FF31000000757F00406DFFFFFFFFFF',
    '0015FF000000003F040814FFFFFFFFFF',
    '022C1D000004AF22000000FFFFFFFFFF',
    '843DD2000004B65F00C000FFFFFFFFFF',
    '01776B000000001700B014FFFFFFFFFF',
    '1100FF0000048B000060043F88DE54FF',
    'C80005000004090000C014FEFEFEFFFF'
];

$team = Team::factory('louis', 6);
Team::set($team);

foreach ($hexes as $hex) {
    $item = new Item();
    $item->parse($hex);

    it('louis season 6 test parse and make hex [' . $hex . ']', function () use ($item) {
        expect($item->getHex())->toBe($item->make());
    });
}
