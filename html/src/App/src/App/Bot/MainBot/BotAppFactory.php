<?php
declare(strict_types=1);

namespace App\Bot\MainBot;

use Psr\Container\ContainerInterface;
use TgShop\BotApp;
use TgShop\Transport\ImmediateSender;

final class BotAppFactory
{
    public const SERVICE_NAME = 'main_bot_app';

    public function __invoke(ContainerInterface $container): BotApp
    {
        return new BotApp(
            $container->get('config')['telegram']['main_bot']['pipeline'],
            $container->get(ImmediateSender::class),
            $container
        );
    }
}