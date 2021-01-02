<?php
declare(strict_types=1);

namespace App\Bot\StoreBot\Http\Handler;

use App\Bot\StoreBot\BotAppFactory;
use App\Bot\StoreBot\BotProvider;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Handler\DynamicBotUpdateHandler;

final class UpdateHandlerFactory
{
    public const SERVICE_NAME = 'store_bot_update_handler';

    public function __invoke(ContainerInterface $container): DynamicBotUpdateHandler
    {
        return new DynamicBotUpdateHandler(
            $container->get(BotAppFactory::SERVICE_NAME),
            $container->get(BotProvider::class),
            $container->get(LoggerInterface::class)
        );
    }
}