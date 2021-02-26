<?php
namespace MuOnline\Item\File;

use MuOnline\Team\Team;

class File
{

    const ITEM = 0;

    /**
     * @param int $type
     * @return string
     * @throws FileNotFoundException
     */
    public static function path(int $type): string
    {
        $fileName = static::translateFileName($type);
        $team = Team::current();
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

    /**
     * @param $type
     * @return string|null
     */
    private static function translateFileName($type): ?string
    {
        $team = Team::current();

        if ($type === self::ITEM) {
            return $team->getItemFileName();
        }

        return null;
    }

}