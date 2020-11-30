<?php
declare(strict_types=1);

namespace App\Service;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Service\Router;

final class MainBotRouterFactory
{
    public const SERVICE_NAME = 'MainBotRouter';

    public function __invoke(ContainerInterface $container): Router
    {
        return new Router(
            $container->get(MainBotRouteConfigurationFactory::SERVICE_NAME),
            $container->get(LoggerInterface::class)
        );
    }
}