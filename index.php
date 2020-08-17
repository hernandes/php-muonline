<?php

include 'vendor/autoload.php';

ini_set('display_errors', 1);

$item = (new \MuOnline\Item\Item(0, 0))
    ->setDurability(20)
    ->addSkill()
    ->addAncient(1, 5)
    ->addHarmony(20, 40)
    ->addLuck()
    ->addRefine()
    ->addRefine()
    ->generateSerial();

$item2 = new \MuOnline\Item\Item();
$item2->parse('786FFF00275EF5FF00FF', new \MuOnline\Item\Parser\Season0());

dump($item2);

dump($item2->make(new \MuOnline\Item\Maker\Season0()));

$item3 = new \MuOnline\Item\Item();
$item3->setDurability(new \MuOnline\Item\Durability(10));
dump($item3);