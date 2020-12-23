<?php
namespace MuOnline\Item\File\Parser\Item;

use MuOnline\Item\File\Parser\Item as ItemParser;
use MuOnline\Item\Item;

class AbstractParser implements ItemParser
{

    /**
     * @var array
     */
    protected $data = [];

    public function parse()
    {
        throw new \BadMethodCallException('Method parse not implemented yet!');
    }

    /**
     * @param int|null $section
     * @param int|null $index
     * @return array|null
     */
    public function getData(?int $section = null, ?int $index = null): ?array
    {
        $this->readOrParse();

        if ($section !== null && $index !== null) {
            return $this->data[$section][$index] ?? null;
        }

        return $this->data;
    }

    /**
     * @param Item $item
     * @param bool $durability
     * @return $this
     */
    public function setItemData(Item $item, bool $durability = false): self
    {
        $section = $item->getSection();
        $index = $item->getIndex();
        $data = $this->getData($section, $index);

        if (! $data) {
            throw new \RuntimeException('No item found for ' . $section . ' - ' . $index);
        }

        $item->setName($data['name'])
            ->setWidth($data['width'])
            ->setHeight($data['height']);

        if ($durability) {
            $item->setDurability($data['durability']);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isNeedParse(): bool
    {
        $cache = filemtime($this->getFileCachePath());
        $source = filemtime($this->getFilePath());

        return $source > $cache;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return '/Users/hernandes/MuOnline/php-muonline-item/storage/muonline/files/igcn/ItemList.xml';
    }

    /**
     * @return string
     */
    public function getFileCachePath(): string
    {
        return '/Users/hernandes/MuOnline/php-muonline-item/storage/muonline/cache/items.cache';
    }

    public function readOrParse()
    {
        if ($this->isNeedParse()) {
            $this->parse();

            file_put_contents($this->getFileCachePath(), serialize($this->data));
        } else {
            if (empty($this->data)) {
                $this->data = unserialize(file_get_contents($this->getFileCachePath()));
            }
        }
    }

}