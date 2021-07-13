<?php
namespace MuOnline\Item\Maker\Louis;

use MuOnline\Item\Item;
use MuOnline\Item\Maker\AbstractMaker;

class BaseMaker extends AbstractMaker
{

    public function make(Item $item): string
    {
        if ($item->getIndex() === null || $item->getSection() === null) {
            return str_repeat('F', 32);
        }

        $index = $item->getIndex();
        if ($index >= 255) {
            $index -= 256;
        }

        $hex = $this->pad(dechex($index));

        $level = $item->getLevel() * 8;
        $level += $item->getSkill()->has() ? 128 : 0;
        $level += $item->getLuck()->has() ? 4 : 0;

        switch ($item->getOption()) {
            case 4:
            case 20:
                $level += 1;
                break;
            case 8:
            case 24:
                $level += 2;
                break;
            case 12:
            case 28:
                $level += 3;
                break;
        }

        $hex .= $this->pad(dechex($level));
        $hex .= $this->pad(dechex($item->getDurability()->get()));
        $hex .= $this->pad($item->getSerial()->get(), 8);

        $excellent = $item->getIndex() >= 256 ? 128 : 0;
        $excellent += $item->getOption() >= 16 ? 64 : 0;
        $excellent += $item->getExcellentSlot(0)->has() ? 1 : 0;
        $excellent += $item->getExcellentSlot(1)->has() ? 2 : 0;
        $excellent += $item->getExcellentSlot(2)->has() ? 4 : 0;
        $excellent += $item->getExcellentSlot(3)->has() ? 8 : 0;
        $excellent += $item->getExcellentSlot(4)->has() ? 16 : 0;
        $excellent += $item->getExcellentSlot(5)->has() ? 32 : 0;

        $hex .= $this->pad(dechex($excellent));
        $hex .= $this->pad(dechex($item->getAncient()->get()));
        $hex .= dechex($item->getSection());
        $hex .= dechex(($item->getRefine()->has() ? 8 : 0) + ($item->getTime()->has() ? 2 : 0));

        if ($item->getHarmony()->has()) {
            $hex .= dechex($item->getHarmony()->getType());
            $hex .= dechex($item->getHarmony()->getLevel());
        } else {
            $hex .= '00';
        }

        for ($i = 0; $i < 5; $i++) {
            $socket = $item->getSocketSlot($i);
            $hex .= $this->pad(dechex($socket->get()));
        }

        return strtoupper($hex);
    }
}