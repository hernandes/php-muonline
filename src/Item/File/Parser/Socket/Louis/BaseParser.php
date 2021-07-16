<?php
namespace MuOnline\Item\File\Parser\Socket\Louis;

use MuOnline\Item\File\File;
use MuOnline\Item\File\FileNotFoundException;
use MuOnline\Item\File\Parser\Socket\AbstractParser;

abstract class BaseParser extends AbstractParser
{

    /**
     * @throws FileNotFoundException
     */
    public function parse(): void
    {
        $fileTypes = File::path('socket_type');
        $fileOptions = File::path('socket_option');

        $sockets = [];
        $options = File::parse($fileOptions, 0);
        foreach ($options as $line) {
            for ($i = 0; $i < 5; $i++) {
                $value = $line[0] + ($i * 50);
                $bonus = $line[$i + 5];

                $sockets[$value] = [
                    'id' => (int)$line[0],
                    'level' => $i,
                    'element' => (int)$line[1],
                    'bonus' => (int)$bonus,
                    'name' => $line[3],
                    'value' => (int)$value
                ];
            }
        }
        $this->sockets = $sockets;

        $bonuses = [];
        $options = File::parse($fileOptions, 1);
        foreach ($options as $line) {
            $bonuses[$line[0]] = [
                'index' => (int)$line[0],
                'section_start' => (int)$line[1],
                'section_end' => (int)$line[2],
                'name' => $line[3],
                'value' => (int)$line[4],
                'req_1' => (int)$line[5],
                'req_2' => (int)$line[6],
                'req_3' => (int)$line[7],
                'req_4' => (int)$line[8],
                'req_5' => (int)$line[9]
            ];
        }
        $this->bonuses = $bonuses;

        $items = [];
        $types = File::parse($fileTypes);
        foreach ($types as $type) {
            $items[$type[0]][$type[1]] = [
                'max' => (int)$type[2]
            ];
        }
        $this->items = $items;
    }

}