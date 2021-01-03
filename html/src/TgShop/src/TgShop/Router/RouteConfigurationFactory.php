<?php
declare(strict_types=1);

namespace TgShop\Router;

use Psr\Container\ContainerInterface;

abstract class RouteConfigurationFactory
{
    public function __invoke(ContainerInterface $container): RouteConfiguration
    {
        $routes = $this->getRoutes($container);

        return new RouteConfiguration($routes);
    }

    abstract protected function getRoutes(ContainerInterface $container): array;
}