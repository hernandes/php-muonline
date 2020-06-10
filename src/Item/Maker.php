<?php
namespace MuOnline\Item;

interface Maker
{

    public function make(Item $item): string;

}