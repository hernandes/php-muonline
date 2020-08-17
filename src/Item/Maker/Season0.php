<?php
namespace MuOnline\Item\Maker;

use MuOnline\Item\Item;
use MuOnline\Item\Maker;

class Season0 extends AbstractMaker
{

    /**
     * @param Item $item
     * @return string
     */
    public function make(Item $item): string
    {
        if ($item->getIndex() === null || $item->getSection() === null) {
            return str_repeat('F', 20);
        }

        $hex = '';

        $unique = $item->getSection() * 32 > 255;
        $hex .= $this->fix(dechex((($item->getIndex() & 0x1F) | (($item->getSection() << 5) & 0xE0)) & 0xFF));

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
            case 16:
                $level += 0;
                break;
        }

        $hex .= $this->fix(dechex($level));
        $hex .= $this->fix(dechex($item->getDurability()->get()));
        $hex .= $this->fix($item->getSerial()->get(), 8);

        $excellent = $unique ? 128 : 0;
        $excellent += $item->getOption() >= 16 ? 64 : 0;
        $excellent += $item->getExcellentSlot(0)->has() ? 1 : 0;
        $excellent += $item->getExcellentSlot(1)->has() ? 2 : 0;
        $excellent += $item->getExcellentSlot(2)->has() ? 4 : 0;
        $excellent += $item->getExcellentSlot(3)->has() ? 8 : 0;
        $excellent += $item->getExcellentSlot(4)->has() ? 16 : 0;
        $excellent += $item->getExcellentSlot(5)->has() ? 32 : 0;

        $hex .= $this->fix(dechex($excellent));
        $hex .= '00FF';

        return strtoupper($hex);
    }
}