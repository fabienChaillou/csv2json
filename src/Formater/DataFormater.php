<?php

namespace Formater;

use DI\Container;
use Filesystem\Reader\Reader;
use http\Exception\BadQueryStringException;

class DataFormater
{
    use HelperFormaterTrait;

    public function format(array $data, array $filters = []): array
    {
        if (empty($data)) {
            throw new \Exception('Data is empty!');
        }

        if ($filters['fields']) {
            $header = $this->getUselessHeader($filters['fields']);
            $data = $this->consolidateData($data, $header);
        }

        if ($filters['aggregate']) {
            $data = $this->aggregateData($data, $filters['aggregate']);
        }

        return $data;

    }

    private function aggregateData(array $data, string $fields): array
    {
        $fields = $this->validateFields($fields);

        $values = array_unique(array_column($data, $fields[0]));

        foreach ($data as $k => $v) {
            array_walk_recursive( $v, function($value, $key) use ($values, $k, $v, &$data, $fields) {
                if ($fields[0] === $key)  {
                    unset($v[$key]);
                    $data[$value][] = $v;
                    unset($data[$k]);
                }
            }, $data);
        }

        return $data;
    }


    private function consolidateData(array $data, array $header): array
    {
        $data = array_map(function ($index) use ($header) {
            return array_diff_key($index, array_flip($header));
        }, $data);

        return $data;
    }

    private function getUselessHeader(string $fields = null): array
    {
        $fields = $this->validateFields($fields);

        return array_diff(
            $this->getReader()->parseHeader(dirname(__DIR__) . '/../' . Container::PATH_DATA, Container::CSV_FILE_NAME),
            $fields
        );
    }

    private function validateFields(array $fields): array
    {
        $fields = $this->explode($fields);

        $header = $this->getReader()->parseHeader(dirname(__DIR__) . '/../' . Container::PATH_DATA, Container::CSV_FILE_NAME);

        $diff = array_diff($fields, array_merge($fields, $header));

        if (count($diff) > 0) {
            throw new \Exception(sprintf("this field %s is not valid!", implode(',', $diff)));
        }

        return $fields;
    }

    private function getReader(): Reader
    {
        return Container::getReader();
    }

}