<?php

include 'vendor/autoload.php';

ini_set('display_errors', 1);

$team = new \MuOnline\Team\IGCN();
$team->setSeason(\MuOnline\Team\Season::SEASON_15);

\MuOnline\Team\Team::setCurrent($team);

$item = (new \MuOnline\Item\Item(0, 0));
$item->setDurability(20)
    ->addSkill()
    ->addAncient(1, 5)
    ->addHarmony(20, 40)
    ->addLuck()
    ->addRefine()
    ->addRefine()
    ->generateSerial();

$item2 = new \MuOnline\Item\Item();
$item2->parse('786FFF00275EF5FF00FF');

dump($item2);

dump($item2->make());

$item3 = new \MuOnline\Item\Item();
$item3->setLevel(12);
$item3->updateFromFile();
dump($item3);