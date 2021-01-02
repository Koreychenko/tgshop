<?php
declare(strict_types=1);

namespace App\Bot\StoreBot\Router;

use Psr\Container\ContainerInterface;
use TgShop\Router\RouteConfigurationInterface;
use TgShop\Router\RouterFactory as CommonRouterFactory;

final class RouterFactory extends CommonRouterFactory
{
    public const SERVICE_NAME = 'store_bot_router';

    protected function getRouterConfiguration(ContainerInterface $container): RouteConfigurationInterface
    {
        return $container->get(RouteConfigurationFactory::SERVICE_NAME);
    }
}