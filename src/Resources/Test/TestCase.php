<?php

namespace Resources\test;

class TestCase
{
    private $counter = 0;

    public function getCounter()
    {
        return $this->counter;
    }

    protected function setCounter()
    {
        $this->counter++;
    }

    protected function assertEquals(string $expected, string $require)
    {
        \assert($require === $expected);
    }

    protected function assertTrue(bool $condition)
    {
        \assert($condition === true);
    }

    protected function assertFalse(bool $condition)
    {
        \assert($condition === false);
    }

}
