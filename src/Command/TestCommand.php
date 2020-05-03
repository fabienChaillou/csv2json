<?php

namespace Command;

use http\Exception\InvalidArgumentException;
use Input\InputInterface;
use Input\InputType;
use Output\OutputInterface;

class TestCommand extends Command
{
    const NAME = 'test';

    protected function configure()
    {
        $this
            ->setName(static::NAME)
            ->setDescription('Run the test')
        ;
    }

    public function execute()
    {
        $this->output->write('todo run the test in test directory!');

        return OutputInterface::SUCCESS;
    }
}
