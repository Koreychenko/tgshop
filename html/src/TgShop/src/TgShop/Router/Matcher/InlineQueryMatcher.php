<?php


namespace TgShop\Router\Matcher;


use Psr\Container\ContainerInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Router\RouteConfigurationInterface;

class InlineQueryMatcher implements RouterMatcherInterface
{
    public const SECTION = 'inline_query';

    public function match(
        TelegramRequestInterface $telegramRequest,
        RouteConfigurationInterface $routeConfiguration,
        ContainerInterface $container
    ): ?array {
        if (empty($routeConfiguration->getQueries())) {
            return null;
        }

        if (!$telegramRequest->getUpdate()->getCallbackQuery()) {
            return null;
        }

        $data = $telegramRequest->getUpdate()->getCallbackQuery()->getData();

        $path = parse_url($data, PHP_URL_PATH);

        $routes = $routeConfiguration->getQueryRoutes($path);

        if (!$routes) {
            return null;
        }

        $query = parse_url($telegramRequest->getUpdate()->getCallbackQuery()->getData(), PHP_URL_QUERY);

        if ($query) {
            $queryParams = [];
            parse_str($query, $queryParams);

            if (!empty($queryParams)) {
                $telegramRequest->setParameters($queryParams);
            }
        }

        return $routes;
    }
}