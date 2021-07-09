<?php
namespace MuOnline\Item\File\Parser\Item;

use MuOnline\Item\File\File;
use MuOnline\Item\File\Parser\Item as ItemParser;
use MuOnline\Item\Item;
use BadMethodCallException;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;
use RuntimeException;
use MuOnline\Item\File\FileNotFoundException;
use Throwable;

class AbstractParser implements ItemParser
{

    protected array $items = [];
    protected array $categories = [];

    public function parse(): void
    {
        throw new BadMethodCallException('Method parse not implemented yet!');
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
            throw new RuntimeException('No item instantiated');
        }

        $data = $this->getItem($section, $index);

        if (! $data) {
            throw new RuntimeException('No item found for ' . $section . ' - ' . $index);
        }

        $item->setName($data['name'])
            ->setWidth($data['width'])
            ->setHeight($data['height']);

        if ($durability) {
            $item->getDurability()->set($data['durability']);
        }

        return $this;
    }

    /**
     * @throws FileNotFoundException
     */
    public function getFilePath(): string
    {
        return File::path(File::ITEM);
    }

    public function getCachePath(): string
    {
        return storage_path('muonline' . DS . 'cache' . DS);
    }

    /**
     * @throws Throwable
     */
    public function read(): void
    {
        $storage = new FileStorage($this->getCachePath());
        $cache = new Cache($storage);

        $key = 'items';

        $data = $cache->load($key, function (&$dependencies) {
            $dependencies[Cache::CALLBACKS] = [
                ['file_modified', $this->getFilePath()]
            ];

            $this->parse();

            return [
                'items' => $this->items,
                'categories' => $this->categories
            ];
        });

        $this->items = $data['items'];
        $this->categories = $data['categories'];
    }

}