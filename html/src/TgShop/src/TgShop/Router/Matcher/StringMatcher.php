<?php
declare(strict_types=1);

namespace TgShop\Router\Matcher;

use Psr\Container\ContainerInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Router\RouteConfigurationInterface;

class StringMatcher implements RouterMatcherInterface
{
    public const SECTION = 'string';

    public function match(
        TelegramRequestInterface $telegramRequest,
        RouteConfigurationInterface $routeConfiguration,
        ContainerInterface $container
    ): ?array {
        $update = $telegramRequest->getUpdate();

        if (empty($routeConfiguration->getStrings())) {
            return null;
        }

        if (!$update->getMessage()) {
            return null;
        }

        $routes = $routeConfiguration->getStringRoutes($update->getMessage()->getText());

        if ($routes) {
            return $routes;
        }

        return null;
    }
}