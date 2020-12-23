<?php
namespace MuOnline\Item\File\Parser\Item\IGCN;

use MuOnline\Item\File\Parser\Item\AbstractParser;
use DOMDocument;

class Season0 extends AbstractParser
{

    public function parse()
    {
        $xml = new DOMDocument();
        $xml->load($this->getFilePath());

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

                $this->data[$section->getAttribute('Index')][$item->getAttribute('Index')] = $data;
            }
        }
    }

}