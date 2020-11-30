<?php
declare(strict_types=1);

namespace TgShop\Service;

use Psr\Container\ContainerInterface;

abstract class RouteConfigurationFactory
{
    public function __invoke(ContainerInterface $container): RouteConfiguration
    {
        $routes = $this->getRoutes($container);

        $routesServices = [];

        foreach ($routes as $group => $groupRoutes) {
            if (!array_key_exists($group, $routesServices)) {
                $routesServices[$group] = [];
            }

            foreach ($groupRoutes as $pattern => $patternRoutes) {
                if (!array_key_exists($pattern, $routesServices[$group])) {
                    $routesServices[$group][$pattern] = [];
                }

                foreach ($patternRoutes as $route) {
                    $routesServices[$group][$pattern][] = $container->get($route);
                }
            }
        }

        return new RouteConfiguration($routesServices);
    }

    abstract protected function getRoutes(ContainerInterface $container): array;
}