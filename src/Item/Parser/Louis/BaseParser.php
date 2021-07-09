<?php
namespace MuOnline\Item\Parser\Louis;

use MuOnline\Item\Item;
use MuOnline\Item\Parser\AbstractParser;

class BaseParser extends AbstractParser
{

    /**
     * @param Item $item
     * @return void
     */
    public function parse(Item $item): void
    {
        $hex = $this->getHex();
        $item->setHex($hex);

        $index = hexdec(substr($hex, 0, 2));
        $index2 = hexdec(substr($hex,14,2));
        if ($index2 >= 128) {
            $index += 256;
        }
        $item->setIndex($index);

        $section = hexdec(substr($hex, 18, 1));
        $item->setSection($section);

        $level = (hexdec(substr($hex, 2, 2)) & 0x78) >> 3;
        $item->setLevel($level);

        $item->setOption($this->parseOption($hex));

        $excellent = hexdec(substr($this->getHex(), 14, 2));
        $item->getExcellentSlot(0)->set(($excellent & 0x01) == 0x01);
        $item->getExcellentSlot(1)->set(($excellent & 0x02) == 0x02);
        $item->getExcellentSlot(2)->set(($excellent & 0x04) == 0x04);
        $item->getExcellentSlot(3)->set(($excellent & 0x08) == 0x08);
        $item->getExcellentSlot(4)->set(($excellent & 0x10) == 0x10);
        $item->getExcellentSlot(5)->set(($excellent & 0x20) == 0x20);

        $durability = hexdec(substr($hex, 4, 2));
        $item->getDurability()->set($durability);

        $luck = (bool) (hexdec(substr($hex, 2, 2)) & 0x04) == 0x04;
        $item->getLuck()->set($luck);

        $skill = (bool) (hexdec(substr($hex, 2, 2)) & 0x80) == 0x80;
        $item->getSkill()->set($skill);

        $serial = substr($this->getHex(), 6, 8);
        $item->getSerial()->set($serial);

        $ancient = hexdec(substr($hex, 17, 1));
        $item->getAncient()->parse($ancient);

        $refine = in_array(hexdec(substr($hex, 19, 1)), [8, 10]);
        $item->getRefine()->set($refine);

        $harmony = hexdec(substr($hex, 20, 2));
        $item->getHarmony()->parse($harmony);

        $item->getSocketSlot(0)->parse(hexdec(substr($hex, 22, 2)));
        $item->getSocketSlot(1)->parse(hexdec(substr($hex, 24, 2)));
        $item->getSocketSlot(2)->parse(hexdec(substr($hex, 25, 2)));
        $item->getSocketSlot(3)->parse(hexdec(substr($hex, 28, 2)));
        $item->getSocketSlot(4)->parse(hexdec(substr($hex, 30, 2)));

        $bonus = hexdec(substr($hex, 20, 2));
        $item->getSocket()->getBonus()->set($bonus);

        $item->setDirty(false);
    }

    private function parseOption(string $hex): int
    {
        $temp = hexdec(substr($hex, 2, 2));
        $temp2 = hexdec(substr($hex, 14, 2));

        if ($temp2 >= 128) {
            $temp2 -= 128;
        }

        if ($temp >= 128) {
            $temp -= 128;
        }

        $temp -= floor($temp / 8) * 8;

        if ($temp >= 4) {
            $temp -= 4;
        }

        if ($temp2 >= 64) {
            $temp += 4;
        }

        return $temp * 4;
    }

}