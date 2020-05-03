<?php

namespace DI;

use Filesystem\Filesystem;
use Filesystem\Reader\Reader;
use Filesystem\Terminal;
use Filesystem\Writer\Writer;
use Formater\DataFormater;

class Container
{
    const PATH_DATA = '/var/data';

    private $definitions = [];

    public static function getParametters()
    {
        return [
            'path-data' => static::PATH_DATA,
        ];
    }

    public static function getDataFormater(): DataFormater
    {
        return new DataFormater();
    }

    public static function getReader(): Reader
    {
        return new Reader();
    }

    public static function getWriter(): Writer
    {
        return new Writer();
    }

    public static function getFilesystem(): Filesystem
    {
        return new Filesystem();
    }

    public static function getTerminal(): Terminal
    {
        return new Terminal();
    }

    public function addDefinition(array $config)
    {
        $this->definitions = $config;
    }

    public function getDefinitions(): array
    {
        return $this->definitions;
    }
}
