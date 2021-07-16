<?php
namespace MuOnline\Item\File\Parser\Item\Louis;

use MuOnline\Item\File\File;
use MuOnline\Item\File\FileNotFoundException;
use MuOnline\Item\File\Parser\Item\AbstractParser;

abstract class BaseParser extends AbstractParser
{

    protected array $categories = [
        0 => 'Swords',
        1 => 'Axes',
        2 => 'Scepters',
        3 => 'Spears',
        4 => 'Bows',
        5 => 'Staffs',
        6 => 'Shields',
        7 => 'Helms',
        8 => 'Armors',
        9 => 'Pants',
        10 => 'Gloves',
        11 => 'Boots',
        12 => 'Accessories',
        13 => 'Miscellaneous Items',
        14 => 'Miscellaneous Items II',
        15 => 'Scrolls'
    ];

    /**
     * @throws FileNotFoundException
     */
    public function parse(): void
    {
        $filename = $this->getFilePath();
        $categories = File::parse($filename, '*');

        foreach ($categories as $section => $category) {
            foreach ($category as $line) {
                $data = [
                    'type' => $line[0],
                    'name' => $line[8],
                    'width' => $line[3],
                    'height' => $line[4],
                    'id' => $line[0],
                    'skill' => 0,
                    'slot' => $line[1],
                    'durability' => 0
                ];

                $this->items[$section][$line[0]] = $data;
            }
        }
    }

}