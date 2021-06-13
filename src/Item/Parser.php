<?php
namespace MuOnline\Item;

interface Parser
{

    public function parse(Item $item): void;

}