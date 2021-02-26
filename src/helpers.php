<?php

if (! defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (! function_exists('storage_path')) {
    function storage_path($path = null)
    {
        return ROOT . DS . 'storage' . DS . $path;
    }
}