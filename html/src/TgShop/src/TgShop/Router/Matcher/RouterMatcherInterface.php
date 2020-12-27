<?php
declare(strict_types=1);

namespace TgShop\Router\Matcher;

use Psr\Container\ContainerInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Router\RouteConfigurationInterface;

interface RouterMatcherInterface
{
    public function match(
        TelegramRequestInterface $telegramRequest,
        RouteConfigurationInterface $routeConfiguration,
        ContainerInterface $container
    ): ?array;
}