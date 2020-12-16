<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require 'vendor/autoload.php';

/** @var \Psr\Container\ContainerInterface $container */
$container     = require 'config/container.php';
$entityManager = $container->get(EntityManagerInterface::class);

return ConsoleRunner::createHelperSet($entityManager);