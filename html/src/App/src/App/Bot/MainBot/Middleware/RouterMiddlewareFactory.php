<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware;

use App\Bot\MainBot\Router\RouterFactory;
use Psr\Container\ContainerInterface;
use TgShop\Middleware\RouterMiddleware;

final class RouterMiddlewareFactory
{
    public const SERVICE_NAME = 'main_bot_router_middleware';

    public function __invoke(ContainerInterface $container): RouterMiddleware
    {
        return new RouterMiddleware($container->get(RouterFactory::SERVICE_NAME));
    }
}