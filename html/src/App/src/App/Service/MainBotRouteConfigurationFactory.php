<?php
declare(strict_types=1);

namespace App\Service;

use Psr\Container\ContainerInterface;
use TgShop\Service\RouteConfigurationFactory;

class MainBotRouteConfigurationFactory extends RouteConfigurationFactory
{
    public const SERVICE_NAME = 'MainBotRouteConfiguration';

    protected function getRoutes(ContainerInterface $container): array
    {
        return $container->get('config')['telegram']['main_bot']['router'];
    }
}