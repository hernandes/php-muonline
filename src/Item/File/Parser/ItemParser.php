<?php
namespace MuOnline\Item\File\Parser;

use MuOnline\Item\Item;

interface ItemParser
{

    public function parse(): void;

    public function getItems(): array;

    public function getItem(int $section, int $index): ?array;

    public function getCategories(): array;

    public function sync(Item $item, bool $durability = false): self;

}