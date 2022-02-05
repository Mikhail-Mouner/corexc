<?php

spl_autoload_register('Autoloader::ClassLoader');

class Autoloader
{
    const DS = DIRECTORY_SEPARATOR;

    public static function ClassLoader($class)
    {
        $class = str_replace('\\', self::DS, $class);
        require_once "{$class}.php";
    }
}
