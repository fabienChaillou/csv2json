<?php

namespace Resources\Test\Command;

use Command\Command;
use Command\CommandFactory;
use DI\Container;
use Resources\test\TestCase;
use Resources\Test\TestHelperTrait;
use Resources\Test\TestInterface;

class CommandTest extends TestCase implements TestInterface
{
    use TestHelperTrait;

    /**
     * @var Command
     */
    private $instance;

    public function __construct()
    {
        $this->instance = new Command();
    }

    public function load()
    {
        $this->checkDependenciesOfClass();
        $this->getNameTest();

        echo $this->getCounter() . TestInterface::SUCCESS . 'for ' . get_class($this) . ' class';
        echo "\n";
    }

    private function checkDependenciesOfClass()
    {
        $definitions = [
            'input' => CommandFactory::createInputInterface(),
            'output' => CommandFactory::createOutputInterface(),
            'terminal' => Container::getTerminal(),
        ];

        foreach ($this->invokeAllPropertiesClass($this->instance) as $key => $property)
        {
            $value = $this->invokePropertyClass(get_class($this->instance), $this->instance, $property->getName());

            if (is_null($value)) {
                continue;
            }

            $className = get_class($definitions[$property->getName()]);
            $this->assertTrue(($value instanceof $className));
            $this->setCounter();

        }
    }

    private function getNameTest()
    {
        foreach (['foo', 'bar', 'baz'] as $key => $name)
        {
            $this->instance->setName($name);
            $this->assertEquals($this->instance->getName(), $name);
            $this->setCounter();
        }
    }
}
