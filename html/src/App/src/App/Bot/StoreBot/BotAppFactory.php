<?php
declare(strict_types=1);

namespace App\Bot\StoreBot;

use Psr\Container\ContainerInterface;
use TgShop\BotApp;
use TgShop\Transport\ImmediateSender;

final class BotAppFactory
{
    public const SERVICE_NAME = 'store_bot_app';

    public function __invoke(ContainerInterface $container): BotApp
    {
        return new BotApp(
            $container->get('config')['telegram']['store_bot']['pipeline'],
            $container->get(ImmediateSender::class),
            $container
        );
    }
}