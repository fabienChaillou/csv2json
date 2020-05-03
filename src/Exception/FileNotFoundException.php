<?php

namespace Exception;

class FileNotFoundException extends \RuntimeException
{
    public function __construct(string $resource = null, int $code = 0, \Throwable $previous = null, string $path = null)
    {
        if (is_null($resource)) {
            $message = 'File could not be found.';
        } else {
            $message = sprintf('File "%s" could not be found.', $resource);
        }

        parent::__construct($message, $code, $previous, $path);
    }
}
