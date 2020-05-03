<?php

namespace Resources\Test;

interface TestInterface
{
    const SUCCESS =' tests: Success ';
    const ERROR =' tests: Error ';

    public function load();
}