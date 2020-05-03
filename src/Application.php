<?php

declare(strict_types=1);

use DI\Container;
use Resources\Config\AbstractApplication;

class Application extends AbstractApplication
{
    /**
     * @var Container
     */
    protected $container;

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

}
