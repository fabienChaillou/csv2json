<?php

use \DI\Container;

require dirname(__DIR__) . '/config/autoload.php';
Autoloader::register();

$container = new Container();
$container->addDefinition(require __DIR__ . '/config.php');

return $container;
