<?php

declare(strict_types=1);

namespace Output;

use DI\Container;

class Output
{
    private $terminal;

    public function __construct()
    {
        $this->terminal = Container::getTerminal();
    }

    public function write(string $message)
  {
      return $this->terminal->execute($message);
  }
}
