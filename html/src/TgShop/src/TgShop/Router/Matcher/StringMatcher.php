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

        if (!$update->getMessage()) {
            return null;
        }

        return $routeConfiguration->getSectionRoutes(static::SECTION, $update->getMessage()->getText());
    }

    private function cleanEmoji(string $text): string
    {
        return trim($text);
    }
}