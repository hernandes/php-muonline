<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Item;
use MuOnline\Item\Luck;
use MuOnline\Item\Serial;
use MuOnline\Item\Skill;

class Season0 extends AbstractParser
{

    /**
     * @param Item $item
     * @return void
     */
    public function parse(Item $item)
    {
        $hex = $this->getHex();
        $item->setHex($hex);

        $section = hexdec(substr($hex, 0, 2));
        $unique = hexdec(substr($hex, 14, 2));
        $item->setSection((($section & 0xE0) >> 5) + ((($unique & 0x80) === 0x80) ? 8 : 0));

        $index = hexdec(substr($hex, 0, 2));
        $item->setIndex($index);

        $level = (hexdec(substr($hex, 2, 2)) & 0x78) >> 3;
        $item->setLevel($level);

        $durability = hexdec(substr($hex, 4, 2));
        $item->setDurability($durability);

        $luck = (hexdec(substr($hex, 2, 2)) & 0x04) === 0x04;
        $item->setLuck(new Luck($luck));

        $skill = (hexdec(substr($hex, 2, 2)) & 0x80) === 0x80;
        $item->setSkill(new Skill($skill));

        $item->setOption($this->getOption($hex));

        $excellent = hexdec(substr($hex, 14, 2));
        $item->addExcellentInSlot(0, ($excellent & 0x01) === 0x01);
        $item->addExcellentInSlot(1, ($excellent & 0x02) === 0x02);
        $item->addExcellentInSlot(2, ($excellent & 0x04) === 0x04);
        $item->addExcellentInSlot(3, ($excellent & 0x08) === 0x08);
        $item->addExcellentInSlot(4, ($excellent & 0x10) === 0x10);
        $item->addExcellentInSlot(5, ($excellent & 0x20) === 0x20);

        $serial = substr($hex, 6, 8);
        $item->setSerial(new Serial($serial));
    }

    /**
     * @param $hex
     * @return int
     */
    protected function getOption($hex): int
    {
        $temp = hexdec(substr($hex, 2, 2));
        $temp2 = hexdec(substr($this->getHex(), 14, 2));

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

        return (int) $temp * 4;
    }

}