<?php

namespace Filesystem\Reader;

use Exception\FileNotFoundException;

class Reader
{
    const DELIMITER = ',';

    public function parse($path, $file): array
    {
        $filename = sprintf('%s/%s', $path, $file);

        if (!file_exists($filename) || !is_readable($filename)) {
            throw new FileNotFoundException();
        }

        return $this->csvToArray($filename);
    }

    public function parseHeader($path, $file): array
    {
        $filename = sprintf('%s/%s', $path, $file);

        if (!file_exists($filename) || !is_readable($filename)) {
            throw new FileNotFoundException();
        }

        return $this->getHeader($filename);
    }

    private function getHeader(string $filename): array
    {
        if (($handle = fopen($filename, "r")) !== FALSE) {
            $data = stream_get_line($handle, 1000, "\n");

            fclose($handle);
        }

        return explode(',', $data);
    }

    private function csvToArray(string $filename): array
    {
        $header = NULL;
        $data = [];
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, self::DELIMITER)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
