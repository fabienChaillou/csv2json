<?php

namespace Invoker;

use Command\CommandInterface;

class Invoker
{
    /**
     * @var CommandInterface
     */
    protected $command;

    public function setCommand(CommandInterface $command)
    {
        $this->command = $command;
    }

    public function run()
    {
        return $this->command->execute();
    }
}