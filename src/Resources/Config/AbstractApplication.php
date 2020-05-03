<?php

namespace Resources\Config;

use Command\CommandFactory;
use Command\CommandInterface;
use Exception\InvalidArgumentException;
use Invoker\Invoker;

abstract class AbstractApplication
{
    const ARGS_VALID = [
        "--fields",
        "--aggregate",
        "--desc",
        "--pretty",
    ];

    /**
     * @var CommandInterface
     */
    protected $command;

    /**
     * @var Invoker
     */
    protected $invoker;

    public function __construct()
    {
        $this->invoker = new Invoker();

    }

    public function command(array $expression): CommandInterface
    {
        if (count($expression) === 1) {
            $this->command = CommandFactory::factory(null, $this->container->getDefinitions());
            $this->add();

            return $this->command;
        }

        $args = $this->formatArgs($expression);
        if (!in_array($args[0], $this->container->getDefinitions())) {
            throw new \Exception('this command is not valid!');
        }

        $this->command = CommandFactory::factory($args[0]);
        $this->command->initialize($args);
        $this->add();

        return $this->command;
    }

    private function add()
    {
        $this->invoker->setCommand($this->command);
    }

    public function run()
    {
        return $this->invoker->run();
    }

    private function formatArgs(array $argv): array
    {
        unset($argv[0]);

        foreach($this->validateArguments($argv) as $k => $v )
        {
            if (preg_match('/^--/', $v)) {
                ($v === static::ARGS_VALID[3]) ? $argv[$v] = true : $argv[$v] = $argv[$k+1];
                unset($argv[$k]);
                unset($argv[$k+1]);

            }
        }

        return array_merge($argv);
    }

    private function validateArguments(array $arguments)
    {
        foreach($arguments as $v )
        {
            if (preg_match('/^-/', $v) && !in_array($v, static::ARGS_VALID)) {
                throw new InvalidArgumentException('this' . $v . ' is invalid!');
            }
        }
        return $arguments;
    }
}