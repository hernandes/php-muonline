<?php
namespace MuOnline\Item\File\Parser\Item;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use MuOnline\Item\File\File;
use MuOnline\Item\File\Parser\Item as ItemParser;
use MuOnline\Item\Item;
use BadMethodCallException;
use Phpfastcache\CacheManager;
use RuntimeException;
use MuOnline\Item\File\FileNotFoundException;
use Psr\Cache\InvalidArgumentException;

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
        return storage_path('muonline' . DS);
    }

    public function read(): void
    {
        $key = 'items';

        $pool = new FilesystemCachePool(new Filesystem(new Local($this->getCachePath())));
        $item = $pool->getItem($key);

        $cacheFile = $this->getCachePath() . 'cache' . DS . $key;

        if (file_needed_cache($cacheFile, $this->getFilePath()) || ! $item->isHit()) {
            $this->parse();

            $data = [
                'items' => $this->items,
                'categories' => $this->categories
            ];

            $item->set($data);
            $pool->save($item);
        } else {
            $data = $item->get();
        }

        $this->items = $data['items'];
        $this->categories = $data['categories'];
    }

}