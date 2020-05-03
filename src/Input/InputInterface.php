<?php

namespace Input;

interface InputInterface
{
    public function validate();

    public function getArguments();

    public function getArgument(string $name);

    public function setArgument(string $name, $value);

    public function hasArgument($name);

    public function getOptions();

    public function getOption(string $name);

    public function setOption(string $name, $value);

    public function hasOption(string $name);

}
