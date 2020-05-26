<?php

include 'vendor/autoload.php';

ini_set('display_errors', 1);

$item = new \MuOnline\Item\Item(0, 0);
$item->setDurability(new \MuOnline\Item\Durability(20));
$item->addSkill();
$item->addAncient(1, 5);
$item->addHarmony(20, 40);
$item->addLuck();
$item->addRefine();
$item->generateSerial();

echo '<pre>';
print_r($item);
echo '</pre>';