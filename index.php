<?php

include 'vendor/autoload.php';

ini_set('display_errors', 1);

$team = \MuOnline\Team\Team::factory('louis', 6);

\MuOnline\Team\Team::set($team);

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

$item3 = new \MuOnline\Item\Item(0, 0);
$item3->setLevel(12);
$item3->sync();
dump($item3);

$parser = \MuOnline\Item\File\Parser\Item\ParserFactory::factory();
$parser->parse();
dump($parser);