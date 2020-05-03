<?php

namespace Resources\Test;

class Loader
{
    private $counter = 0;
    private $defintions = [];

    public function addDefinitions(array $dafinitions)
    {
        $this->defintions = $dafinitions;
    }

    public function load()
    {
        if (!empty($this->defintions)) {
            foreach ($this->defintions as $definition) {
                $definition->load();
                $this->counter += $definition->getCounter();
            }
        }

        echo $this->counter . TestInterface::SUCCESS;
        echo "\n";
    }
}
