<?php

namespace Resources\Test\DI;

use DI\Container;
use Resources\Test\TestCase;
use Resources\Test\TestInterface;

class ContainerTest extends TestCase implements TestInterface
{
    /**
     * @var Container
     */
    private $instance;

    public function __construct()
    {
        $this->instance = new Container();
    }

    public function load()
    {
        $this->getDefinitionsTest();
        $this->getStaticInstancesTest();

        echo $this->getCounter() . TestInterface::SUCCESS . 'for ' . get_class($this) . ' class';
        echo "\n";
    }

    private function getStaticInstancesTest()
    {
        $definitions = [
            Container::getReader(),
            Container::getFilesystem(),
            Container::getTerminal(),
            Container::getDataFormater(),
            Container::getWriter(),
        ];

        foreach ($definitions as $key => $definition)
        {
            $className = get_class($definitions[$key]);
            $this->assertTrue(($definition instanceof $className));
            $this->setCounter();
        }
    }

    private function getDefinitionsTest()
    {
        $definitions = [];

        foreach (['foo', 'bar', 'baz'] as $key => $value)
        {
            $obj = new \stdClass();
            $obj->name = $value;
            $definitions[$key] = $obj;
        }

        $this->instance->addDefinition($definitions);
        foreach ($this->instance->getDefinitions() as $k => $obj)
        {
            $this->assertEquals($obj->name, $definitions[$k]->name);
            $this->setCounter();
        }

    }
}