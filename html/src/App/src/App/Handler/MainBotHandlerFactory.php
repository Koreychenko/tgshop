<?php
declare(strict_types=1);

namespace App\Handler;

use App\Service\MainStaticBotProvider;
use App\Service\MainBotRouterFactory;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Handler\StaticBotUpdateHandler;

final class MainBotHandlerFactory
{
    public const SERVICE_NAME = 'main_bot_update_handler';

    public function __invoke(ContainerInterface $container): StaticBotUpdateHandler
    {
        $botProvider = $container->get(MainStaticBotProvider::class);

        return new StaticBotUpdateHandler(
            $botProvider->getBot('main_bot'),
            $container->get(MainBotRouterFactory::SERVICE_NAME),
            $container->get(LoggerInterface::class)
        );
    }
}