<?php

namespace Command;

use Input\InputInterface;
use Input\InputType;
use Output\OutputInterface;

class ListCommand extends Command
{
    const NAME = 'list';
    private $definition;

    protected function configure()
    {
        $this
            ->setName(static::NAME)
            ->setDescription('List all commands enabled!')
        ;
    }

    public function __construct(string $name = null, array $definition)
    {
        parent::__construct($name);

        $this->definition = $definition;
    }

    public function execute()
    {
        $this->output->write('commands list:');

        foreach ($this->definition as $definition) {
            $this->output->write(sprintf('%s ## %s',$definition, CommandFactory::factory($definition)->getDescription()));
        }

        return OutputInterface::SUCCESS;
    }
}