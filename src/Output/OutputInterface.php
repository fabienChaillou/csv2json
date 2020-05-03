<?php

namespace Output;

interface OutputInterface
{
    const SUCCESS = 0;
    const FAILURE = 1;

    public function write(string $messages);

//    public function setDecorated(bool $decorated);
//
//    public function isDecorated();
//
//    public function setFormatter(OutputFormatterInterface $formatter);
//
//    /**
//     * Returns current output formatter instance.
//     *
//     * @return OutputFormatterInterface
//     */
//    public function getFormatter();
}
