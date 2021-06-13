<?php
namespace MuOnline\Item\File\Parser\Item\IGCN;

use MuOnline\Item\File\Parser\Item\AbstractParser;
use MuOnline\Item\File\FileNotFoundException;
use DOMDocument;

abstract class BaseParser extends AbstractParser
{

    /**
     * @throws FileNotFoundException
     */
    public function parse(): void
    {
        $file = $this->getFilePath();

        $xml = new DOMDocument();
        $xml->load($file);

        foreach ($xml->getElementsByTagName('Section') as $section) {
            foreach ($section->getElementsByTagName('Item') as $item) {
                $data = [
                    'type' => $item->getAttribute('Type'),
                    'name' => $item->getAttribute('Name'),
                    'width' => $item->getAttribute('Width'),
                    'height' => $item->getAttribute('Height'),
                    'id' => $item->getAttribute('Index'),
                    'skill' => $item->getAttribute('SkillIndex'),
                    'slot' => $item->getAttribute('Slot'),
                    'durability' => $item->getAttribute('Durability')
                ];

                $this->items[$section->getAttribute('Index')][$item->getAttribute('Index')] = $data;
            }

            $this->categories[$section->getAttribute('Index')] = $section->getAttribute('Name');
        }
    }

}