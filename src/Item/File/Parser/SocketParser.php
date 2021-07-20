<?php
namespace MuOnline\Item\File\Parser;

interface SocketParser
{

    public function parse(): void;

    public function getSockets(): array;

    public function getBonuses(): array;

    public function getItems(): array;

    public function getItem(int $section, int $index): ?array;

}