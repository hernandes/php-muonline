<?php
namespace MuOnline\Item\File\Parser\Socket;

use MuOnline\Item\File\File;
use MuOnline\Item\File\Parser\SocketParser;
use BadMethodCallException;
use Psr\Cache\InvalidArgumentException;
use MuOnline\Item\File\FileNotFoundException;

class AbstractParser implements SocketParser
{

    protected array $sockets = [];
    protected array $bonuses = [];
    protected array $items = [];

    public function parse(): void
    {
        throw new BadMethodCallException('Method parse not implemented yet!');
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public function getSockets(): array
    {
        $this->read();

        return $this->sockets;
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public function getBonuses(): array
    {
        $this->read();

        return $this->bonuses;
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
     */
    public function getItems(): array
    {
        $this->read();

        return $this->items;
    }

    /**
     * @throws FileNotFoundException
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
     * @throws FileNotFoundException
     */
    public function read(): void
    {
        $key = 'sockets';

        $pool = File::createCachePool();
        $item = $pool->getItem($key);

        $cacheFile = File::getStoragePath() . 'cache' . DS . $key;

        if (file_needed_cache($cacheFile, File::path('socket_type'), File::path('socket_option')) || ! $item->isHit()) {
            $this->parse();

            $data = [
                'sockets' => $this->sockets,
                'bonuses' => $this->bonuses,
                'items' => $this->items
            ];

            $item->set($data);
            $pool->save($item);
        } else {
            $data = $item->get();
        }

        $this->sockets = $data['sockets'];
        $this->bonuses = $data['bonuses'];
        $this->items = $data['items'];
    }

}