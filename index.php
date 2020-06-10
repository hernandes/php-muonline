<?php

include 'vendor/autoload.php';

ini_set('display_errors', 1);

$item = new \MuOnline\Item\Item(0, 0);
$item->setDurability(20);
$item->addSkill();
$item->addAncient(1, 5);
$item->addHarmony(20, 40);
$item->addLuck();
$item->addRefine();
$item->generateSerial();

$item->make(new \MuOnline\Item\Maker\DefaultMaker());

$item2 = new \MuOnline\Item\Item();
(new \MuOnline\Item\Parser\DefaultParser('abc'))->parse($item2);

echo '<pre>';
print_r($item2);
echo '</pre>';