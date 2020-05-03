<?php

namespace Command;

use Command\Csv2JsonCommand;
use Command\ListCommand;
use Input\Input;
use Output\Output;

final class CommandFactory
{
    public static function factory(string $type = null, array $definition = [])
    {
        if ($type === Csv2JsonCommand::NAME) {
            return new Csv2JsonCommand();
        }
        if ($type === TestCommand::NAME) {
            return new TestCommand();
        }

        return new ListCommand(null, $definition);;
    }

    public static function createInputInterface()
    {
        return new Input();
    }

    public static function createOutputInterface()
    {
        return new Output();
    }
}
