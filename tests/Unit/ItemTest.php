<?php

it('test item dirty', function () {

    $item = new MuOnline\Item\Item();
    expect($item->isDirty())->toBe(false);

    $item = new MuOnline\Item\Item(0, 0);
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->setLevel(4);
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->setOption(4);
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->generateSerial();
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->addAncient(1, \MuOnline\Item\Ancient::STAMINA_10);
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->addLuck();
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->addSkill();
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->addRefine();
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->addExcellentInSlot(0, true);
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->addSocketInSlot(0, 254);
    expect($item->isDirty())->toBe(true);

    $item = new MuOnline\Item\Item();
    $item->addMasteryInSlot(0, true);
    expect($item->isDirty())->toBe(true);

});