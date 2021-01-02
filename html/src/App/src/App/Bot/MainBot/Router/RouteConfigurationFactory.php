<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Router;

use Psr\Container\ContainerInterface;
use TgShop\Router\RouteConfigurationFactory as CommonRouteConfigurationFactory;

class RouteConfigurationFactory extends CommonRouteConfigurationFactory
{
    public const SERVICE_NAME = 'main_bot_route_configuration';

    protected function getRoutes(ContainerInterface $container): array
    {
        return $container->get('config')['telegram']['main_bot']['router'];
    }
}