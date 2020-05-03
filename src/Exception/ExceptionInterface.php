<?php

namespace Exception;

interface ExceptionInterface extends \Throwable
{
    /**
     * @return string|null The path
     */
    public function getPath();
}
