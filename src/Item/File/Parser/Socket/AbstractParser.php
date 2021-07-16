<?php
namespace MuOnline\Item\File\Parser\Socket;

use MuOnline\Item\File\File;
use MuOnline\Item\File\Parser\Item as ItemParser;
use BadMethodCallException;
use Psr\Cache\InvalidArgumentException;
use MuOnline\Item\File\FileNotFoundException;

class AbstractParser implements ItemParser
{

    protected array $sockets = [];
    protected array $bonuses = [];

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
    public function getSocket(int $section, int $index): ?array
    {
        $sockets = $this->getSockets();

        if ($section !== null && $index !== null) {
            return $sockets[$section][$index] ?? null;
        }

        return null;
    }

    public function getBonuses(): array
    {
        return $this->bonuses;
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
                'bonuses' => $this->bonuses
            ];

            $item->set($data);
            $pool->save($item);
        } else {
            $data = $item->get();
        }

        $this->sockets = $data['sockets'];
        $this->bonuses = $data['bonuses'];
    }

}