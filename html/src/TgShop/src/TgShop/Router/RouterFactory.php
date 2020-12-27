<?php
declare(strict_types=1);

namespace TgShop\Router;

use Psr\Container\ContainerInterface;
use TgShop\Router\Matcher\CommandMatcher;
use TgShop\Router\Matcher\InlineQueryMatcher;
use TgShop\Router\Matcher\StateMatcher;
use TgShop\Router\Matcher\StringMatcher;

abstract class RouterFactory
{
    public function __invoke(ContainerInterface $container): Router
    {
        $routerMatchers = [
            $container->get(CommandMatcher::class),
            $container->get(StateMatcher::class),
            $container->get(StringMatcher::class),
            $container->get(InlineQueryMatcher::class),
        ];

        $routerConfiguration = $this->getRouterConfiguration($container);

        return new Router($routerMatchers, $routerConfiguration, $container);
    }

    abstract protected function getRouterConfiguration(ContainerInterface $container): RouteConfigurationInterface;
}