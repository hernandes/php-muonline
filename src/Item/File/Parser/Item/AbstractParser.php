<?php
namespace MuOnline\Item\File\Parser\Item;

use Doctrine\Common\Cache\PhpFileCache;
use MuOnline\Item\File\File;
use MuOnline\Item\File\FileNotFoundException;
use MuOnline\Item\File\Parser\Item as ItemParser;
use MuOnline\Item\Item;

class AbstractParser implements ItemParser
{

    protected array $items = [];
    protected array $categories = [];

    public function parse(): void
    {
        throw new \BadMethodCallException('Method parse not implemented yet!');
    }

    public function getItems(): array
    {
        $this->read();

        return $this->items;
    }

    public function getItem(int $section, int $index): ?array
    {
        $items = $this->getItems();

        if ($section !== null && $index !== null) {
            return $items[$section][$index] ?? null;
        }

        return null;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function sync(Item $item, bool $durability = false): self
    {
        $section = $item->getSection();
        $index = $item->getIndex();

        if (is_null($section) || is_null($index)) {
            throw new \RuntimeException('No item instantiated');
        }

        $data = $this->getItem($section, $index);

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

    public function getFilePath(): string
    {
        return File::path(File::ITEM);
    }

    public function getCachePath(): string
    {
        return storage_path('muonline' . DS . 'cache' . DS);
    }

    /**
     * TODO: melhorar a verificação de quando precisa processar o parse ou não!
     */
    public function read(): void
    {
        $cache = new PhpFileCache($this->getCachePath());

        $key = 'items';
        $lifetime = 60 * 60 * 24;

        $data = $cache->fetch($key);
        if (! $cache->contains($key)) {
            $this->parse();

            $data = [
                'items' => $this->items,
                'categories' => $this->categories
            ];

            $cache->save($key, $data, $lifetime);
        } else {
            $this->items = $data['items'];
            $this->categories = $data['categories'];
        }
    }

}