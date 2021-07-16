<?php

if (! defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (! function_exists('storage_path')) {
    function storage_path($path = null): string
    {
        return ROOT . DS . 'storage' . DS . $path;
    }
}

if (! function_exists('file_cache_modified')) {
    function file_needed_cache(string $cacheFile, ...$files): bool
    {
        foreach ($files as $file) {
            if (file_exists($cacheFile) && filemtime($file) > filemtime($cacheFile)) {
                return true;
            }
        }

        return false;
    }
}