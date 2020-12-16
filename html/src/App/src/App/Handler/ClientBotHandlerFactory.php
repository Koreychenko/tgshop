<?php
declare(strict_types=1);

namespace App\Handler;

use App\Service\ClientDynamicBotProvider;
use App\Service\MainBotRouterFactory;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Handler\DynamicBotUpdateHandler;

final class ClientBotHandlerFactory
{
    public const SERVICE_NAME = 'client_bot_update_handler';

    public function __invoke(ContainerInterface $container): DynamicBotUpdateHandler
    {
        return new DynamicBotUpdateHandler(
            $container->get(ClientDynamicBotProvider::class),
            $container->get(MainBotRouterFactory::SERVICE_NAME),
            $container->get(LoggerInterface::class)
        );
    }
}