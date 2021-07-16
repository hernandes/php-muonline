<?php
namespace MuOnline\Item\File;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use MuOnline\Team\Team;

class File
{

    /**
     * @throws FileNotFoundException
     */
    public static function path(string $type): string
    {
        $team = Team::current();
        $fileName = $team->getFileName($type);
        $base = storage_path('muonline' . DS . 'files' . DS);

        $fullPath = $base . $team->getName() . DS . $team->getSeasonClass() . DS . $fileName;
        if (file_exists($fullPath)) {
            return $fullPath;
        }

        $fullPath = $base . $team->getName() . DS . $fileName;
        if (file_exists($fullPath)) {
            return $fullPath;
        }

        $fullPath = $base . $fileName;
        if (file_exists($fullPath)) {
            return $fullPath;
        }

        throw new FileNotFoundException('File ' . $fileName . ' not found!');
    }

    public static function getStoragePath(): string
    {
        return storage_path('muonline' . DS);
    }

    public static function createCachePool(): FilesystemCachePool
    {
        return new FilesystemCachePool(new Filesystem(new Local(static::getStoragePath())));
    }

    /**
     * @throws FileNotFoundException
     */
    public static function parse(string $filename, $category = null): array
    {
        if (! $file = fopen($filename, 'rb+')) {
            throw new FileNotFoundException($file);
        }

        $current = -1;
        $columns = [];

        while (! feof($file)) {
            $line = fgets($file);
            $line = trim($line, " \t\r\n");

            if (substr($line, 0, 2) === '//'
                || substr($line, 0, 2) === '#'
                || $line === '') {
                continue;
            }

            if (($pos = strpos($line, '//')) !== false) {
                $line = substr($line, 0, $pos);
            }
            $line = trim($line, " \t\r\n");

            $regex = "/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|[\s,]*'([^']+)'[\s,]*|[\s,]+/";

            if ($category === null) {
                if (strtolower($line) === 'end') {
                    break;
                } else {
                    $columns[] = preg_split($regex, $line, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                }
            } else {
                if ($current === -1) {
                    if (is_numeric($line)) {
                        $current = (int)$line;
                    }
                } else {
                    if ($category === '*') {
                        if (strtolower($line) === 'end') {
                            $current = -1;
                            continue;
                        } else {
                            $columns[$current][] = preg_split($regex, $line, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                        }
                    } else {
                        if ($category === $current) {
                            if (strtolower($line) === 'end') {
                                break;
                            } else {
                                $columns[] = preg_split($regex, $line, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                            }
                        } elseif (is_numeric($line)) {
                            $current = (int)$line;
                        }
                    }
                }
            }
        }

        return $columns;
    }

}