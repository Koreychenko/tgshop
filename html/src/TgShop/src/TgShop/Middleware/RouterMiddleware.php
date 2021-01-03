<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use RuntimeException;
use TgShop\Router\RouterInterface;

class RouterMiddleware implements MiddlewareInterface
{
    public const ROUTES = 'routes';

    protected RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $routes = $this->router->match($telegramRequest);

        if (!$routes) {
            throw new RuntimeException('No routes found for the request');
        }

        $telegramRequest->setArgument(static::ROUTES, $routes);
    }
}