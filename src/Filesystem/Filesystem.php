<?php

namespace Filesystem;

use Exception\FileNotFoundException;
use Exception\IOException;

class Filesystem
{
    public function exists(string $file): bool
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException('file not found!');
        }

        return true;
    }
}
