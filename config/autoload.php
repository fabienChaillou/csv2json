<?php

class Autoloader
{
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class)
    {
        $file = dirname(__DIR__) . '\\src\\' . $class . '.php';
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
        if (file_exists($file)) {
            include $file;
            return true;
        }

        return false;
    }
}
