<?php
declare(strict_types=1);

namespace App\Bot\StoreBot\Middleware;

use App\Bot\StoreBot\Router\RouterFactory;
use Psr\Container\ContainerInterface;
use TgShop\Middleware\RouterMiddleware;

final class RouterMiddlewareFactory
{
    public const SERVICE_NAME = 'store_bot_router_middleware';

    public function __invoke(ContainerInterface $container): RouterMiddleware
    {
        return new RouterMiddleware($container->get(RouterFactory::SERVICE_NAME));
    }
}