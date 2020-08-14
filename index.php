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

$item->make(new \MuOnline\Item\Maker\DefaultMaker());

$item2 = new \MuOnline\Item\Item();
$item2->parse('abc', new \MuOnline\Item\Parser\DefaultParser());

echo '<pre>';
print_r($item2);
echo '</pre>';