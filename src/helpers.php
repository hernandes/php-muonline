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

if (! function_exists('file_modified')) {
    function file_modified($path = null): bool
    {
        return true;
    }
}