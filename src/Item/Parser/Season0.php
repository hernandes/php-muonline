<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Ancient;
use MuOnline\Item\Durability;
use MuOnline\Item\Item;
use MuOnline\Item\Luck;
use MuOnline\Item\Refine;
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

        $tempSection = hexdec(substr($hex, 0, 2));
        $tempUnique = hexdec(substr($hex, 14, 2));
        $item->setSection((($tempSection & 0xE0) >> 5) + ((($tempUnique & 0x80) === 0x80) ? 8 : 0));

        $tempIndex = hexdec(substr($hex, 0, 2));
        $item->setIndex($tempIndex);

        $tempLevel = (hexdec(substr($hex, 2, 2)) & 0x78) >> 3;
        $item->setLevel($tempLevel);

        $tempDurability = hexdec(substr($hex, 4, 2));
        $item->setDurability($tempDurability);

        $tempLuck = (hexdec(substr($hex, 2, 2)) & 0x04) === 0x04;
        $item->setLuck(new Luck($tempLuck));

        $tempSkill = (hexdec(substr($hex, 2, 2)) & 0x80) === 0x80;
        $item->setSkill(new Skill($tempSkill));

        $item->setOption($this->parseOption($hex));

        $tempExcellent = hexdec(substr($hex, 14, 2));
        $item->addExcellentInSlot(0, ($tempExcellent & 0x01) === 0x01);
        $item->addExcellentInSlot(1, ($tempExcellent & 0x02) === 0x02);
        $item->addExcellentInSlot(2, ($tempExcellent & 0x04) === 0x04);
        $item->addExcellentInSlot(3, ($tempExcellent & 0x08) === 0x08);
        $item->addExcellentInSlot(4, ($tempExcellent & 0x10) === 0x10);
        $item->addExcellentInSlot(5, ($tempExcellent & 0x20) === 0x20);

        $tempSerial = substr($hex, 6, 8);
        $item->setSerial(new Serial($tempSerial));
    }

    /**
     * @param $hex
     * @return int
     */
    protected function parseOption($hex)
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