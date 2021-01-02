<?php
declare(strict_types=1);

namespace App\Bot\StoreBot;

use App\Bot\StoreBot\Router\RouterFactory;
use Psr\Container\ContainerInterface;
use TgShop\BotApp;
use TgShop\Transport\ImmediateSender;

final class BotAppFactory
{
    public const SERVICE_NAME = 'store_bot_app';

    public function __invoke(ContainerInterface $container): BotApp
    {
        return new BotApp(
            $container->get(RouterFactory::SERVICE_NAME),
            $container->get(ImmediateSender::class),
            $container
        );
    }
}