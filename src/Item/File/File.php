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

}