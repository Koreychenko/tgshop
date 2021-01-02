<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Http\Handler;

use App\Bot\MainBot\BotAppFactory;

use App\Bot\MainBot\BotProvider;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Handler\BotUpdateHandler;

final class UpdateHandlerFactory
{
    public const SERVICE_NAME = 'main_bot_update_handler';

    public function __invoke(ContainerInterface $container): BotUpdateHandler
    {
        $mainBotApp = $container->get(BotAppFactory::SERVICE_NAME);

        $botProvider = $container->get(BotProvider::class);

        return new BotUpdateHandler(
            $mainBotApp,
            $botProvider,
            $container->get(LoggerInterface::class)
        );
    }
}