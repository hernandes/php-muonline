<?php
namespace MuOnline\Item\Parser\Louis;

use MuOnline\Item\Item;
use MuOnline\Item\Parser\AbstractParser;
use MuOnline\Item\File\FileNotFoundException;
use Psr\Cache\InvalidArgumentException;

class BaseParser extends AbstractParser
{

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public function parse(Item $item): void
    {
        $hex = $this->getHex();
        $item->setHex(strtoupper($hex));

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

        $ancient = substr($hex, 17, 1);
        $item->getAncient()->parse($ancient);

        $tmp = hexdec(substr($hex, 19, 1));
        $refine = in_array($tmp, [8, 10]);
        $item->getRefine()->set($refine);

        $time = in_array($tmp, [2, 10]);
        $item->getTime()->set($time);

        $item->getSocketSlot(0)->parse(substr($hex, 22, 2));
        $item->getSocketSlot(1)->parse(substr($hex, 24, 2));
        $item->getSocketSlot(2)->parse(substr($hex, 26, 2));
        $item->getSocketSlot(3)->parse(substr($hex, 28, 2));
        $item->getSocketSlot(4)->parse(substr($hex, 30, 2));

        if ($item->getSocket()->exists()) {
            $bonus = hexdec(substr($hex, 20, 2));
            $item->getSocket()->getBonus()->set($bonus);
        } else {
            $harmony = substr($hex, 20, 2);
            $item->getHarmony()->parse($harmony);
        }

        $item->itsNotDirty();
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