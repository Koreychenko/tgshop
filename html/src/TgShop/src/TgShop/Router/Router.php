<?php
declare(strict_types=1);

namespace TgShop\Router;

use Psr\Container\ContainerInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Router\Matcher\RouterMatcherInterface;

class Router implements RouterInterface
{
    protected RouteConfigurationInterface $routeConfiguration;

    protected ContainerInterface          $container;

    /** @var RouterMatcherInterface[] */
    protected array $routerMatchers;

    public function __construct(
        array $routerMatchers,
        RouteConfigurationInterface $routeConfiguration,
        ContainerInterface $container
    ) {
        $this->routerMatchers     = $routerMatchers;
        $this->routeConfiguration = $routeConfiguration;
        $this->container          = $container;
    }

    public function match(TelegramRequestInterface $telegramRequest): ?array
    {
        foreach ($this->routerMatchers as $routerMatcher) {
            $routes = $routerMatcher->match($telegramRequest, $this->routeConfiguration, $this->container);

            if ($routes) {
                return $routes;
            }
        }

        return null;
    }
}