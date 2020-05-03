<?php

declare(strict_types=1);

namespace Input;

class Input
{
    private $options = [];
    private $arguments = [];

    public function __construct(array $definition = [])
    {
            $this->hydrate($definition);
            //$this->validate();
    }

    public function hydrate(array $definition)
    {
        /* @todo hydrate objects with getter & setter */
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getArgument(string $name)
    {
        return $this->arguments[$name];
    }

    public function setArgument(string $name, $value)
    {
        if (!array_key_exists($name, $this->arguments)) {
            $this->arguments[$name] = $value;
        }

        return $this;
    }

    public function hasArgument($name)
    {
        return array_key_exists($name, $this->arguments);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getOption(string $name)
    {
        return $this->options[$name];
    }

    public function setOption(string $name, $value)
    {
        if (!array_key_exists($name, $this->arguments)) {
            $this->options[$name] = $value;
        }

        return $this;
    }

    public function hasOption(string $name)
    {
        array_key_exists($name, $this->options);
    }
}
