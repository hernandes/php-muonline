<?php
namespace MuOnline\Item\Parser;

use MuOnline\Item\Ancient;
use MuOnline\Item\Durability;
use MuOnline\Item\Item;
use MuOnline\Item\Luck;
use MuOnline\Item\Refine;
use MuOnline\Item\Serial;
use MuOnline\Item\Skill;

class DefaultParser extends AbstractParser
{

    /**
     * @param Item $item
     * @return mixed|void
     */
    public function parse(Item $item)
    {
        $hex = $this->getHex();
        $item->setHex($hex);

        $tempSection = hexdec(substr($hex, 18, 1));
        $item->setSection($tempSection);

        $tempIndex = hexdec(substr($hex, 14, 2));
        $item->setIndex($this->parseIndex($tempIndex, $hex));

        $tempLevel = hexdec(substr($hex, 2, 2));
        $item->setLevel($tempLevel & 0x78 >> 3);

        $tempOption = hexdec(substr($this->getHex(), 2, 2));
        $item->setOption($this->parseOption($tempOption, $hex));

        $tempLuck = hexdec(substr($hex, 2, 2));
        $item->setLuck(new Luck(($tempLuck & 0x04) === 0x04));

        $tempSkill = hexdec(substr($hex, 2, 2));
        $item->setSkill(new Skill(($tempSkill & 0x80) === 0x80));

        $tempAncient = hexdec(substr($hex, 17, 1));
        $item->setAncient((new Ancient())->parse($tempAncient));

        $tempDurability = hexdec(substr($hex, 4, 2));
        $item->setDurability($tempDurability);

        $tempSerial = substr($hex, 6, 8);
        $item->setSerial(new Serial($tempSerial));

        $tempRefine = hexdec(substr($this->getHex(), 19, 1)) === 8;
        $item->setRefine(new Refine($tempRefine));

        $tempHarmonyType = hexdec(substr($this->getHex(), 20, 1));
        $tempHarmonyLevel = hexdec(substr($this->getHex(), 21, 1));
        $item->addHarmony($tempHarmonyType, $tempHarmonyLevel);

        $tempExcellent = substr($hex, 14, 2);
        $item->addExcellentInSlot(0, ($tempExcellent & 0x01) === 0x01);
        $item->addExcellentInSlot(1, ($tempExcellent & 0x02) === 0x02);
        $item->addExcellentInSlot(2, ($tempExcellent & 0x04) === 0x04);
        $item->addExcellentInSlot(3, ($tempExcellent & 0x08) === 0x08);
        $item->addExcellentInSlot(4, ($tempExcellent & 0x10) === 0x10);
        $item->addExcellentInSlot(5, ($tempExcellent & 0x20) === 0x20);

        $tempSocket = str_split(substr($hex, 22, 10), 2);
        $item->addSocketInSlot(0, $tempSocket[0]);
        $item->addSocketInSlot(1, $tempSocket[1]);
        $item->addSocketInSlot(2, $tempSocket[2]);
        $item->addSocketInSlot(3, $tempSocket[3]);
        $item->addSocketInSlot(4, $tempSocket[4]);
    }

    /**
     * @param int $token
     * @param string $hex
     * @return int
     */
    private function parseIndex(int $token, string $hex): int
    {
        return $token;
    }

    /**
     * @param int $token
     * @param string $hex
     * @return int
     */
    private function parseOption(int $token, string $hex): int
    {
        if ($token >= 128) {
            $token -= 128;
        }

        $token -= floor($token / 8) * 8;

        if ($token >= 4) {
            $token -= 4;
        }

        if ($token >= 64) {
            $token += 4;
        }

        return $token * 4;
    }

}