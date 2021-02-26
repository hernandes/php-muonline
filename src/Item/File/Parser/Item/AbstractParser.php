<?php
namespace MuOnline\Item\File\Parser\Item;

use Doctrine\Common\Cache\PhpFileCache;
use MuOnline\Item\File\File;
use MuOnline\Item\File\FileNotFoundException;
use MuOnline\Item\File\Parser\Item as ItemParser;
use MuOnline\Item\Item;
use MuOnline\Team\Team;

class AbstractParser implements ItemParser
{

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var array
     */
    protected $categories = [];

    public function parse()
    {
        throw new \BadMethodCallException('Method parse not implemented yet!');
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        $this->read();

        return $this->items;
    }

    /**
     * @param int $section
     * @param int $index
     * @return array|null
     */
    public function getItem(int $section, int $index): ?array
    {
        $items = $this->getItems();

        if ($section !== null && $index !== null) {
            return $items[$section][$index] ?? null;
        }

        return null;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param Item $item
     * @param bool $durability
     * @return $this
     */
    public function put(Item $item, bool $durability = false): self
    {
        $section = $item->getSection();
        $index = $item->getIndex();
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

    /**
     * @return string
     * @throws FileNotFoundException
     */
    public function getFilePath(): string
    {
        return File::path(File::ITEM);
    }

    /**
     * @return string
     */
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