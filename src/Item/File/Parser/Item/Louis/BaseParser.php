<?php
namespace MuOnline\Item\File\Parser\Item\Louis;

use MuOnline\Item\File\FileNotFoundException;
use MuOnline\Item\File\Parser\Item\AbstractParser;

abstract class BaseParser extends AbstractParser
{

    protected $categories = [
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
    public function parse()
    {
        $file = $this->getFilePath();

        if (! $file = fopen($file, 'rb+')) {
            throw new FileNotFoundException('Was not possible to open the file, verify that the file has permissions');
        }

        $section = -1;
        while (! feof($file)) {
            $line = trim(fgets($file), " \t\r\n");

            if (substr($line, 0, 2) === '//' || substr($line, 0, 2) === '#' || $line === '') {
                continue;
            }

            if (($pos = strpos($line, '//')) !== false) {
                $line = substr($line, 0, $pos);
            }
            $line = trim($line, " \t\r\n");

            if ($section === -1) {
                if (is_numeric($line)) {
                    $section = (int) $line;
                }
            } else {
                if (strtolower($line) == 'end') {
                    $section = -1;
                    continue;
                } else {
                    $columns = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|[\s,]*'([^']+)'[\s,]*|[\s,]+/", $line, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                    $data = [
                        'type' => $columns[0],
                        'name' => $columns[8],
                        'width' => $columns[3],
                        'height' => $columns[4],
                        'id' => $columns[0],
                        'skill' => 0,
                        'slot' => $columns[1],
                        'durability' => 0
                    ];

                    $this->items[$section][$columns[0]] = $data;
                }
            }
        }
    }

}