<?php
declare(strict_types=1);

namespace App\Cli;

use App\Bot\MainBot\BotProvider;
use Psr\Container\ContainerInterface;
use TgShop\Cli\SetWebhookCommand;
use TgShop\Transport\ImmediateSender;

final class SetWebhookCommandFactory
{
    public function __invoke(ContainerInterface $container): SetWebhookCommand
    {
        return new SetWebhookCommand($container->get(BotProvider::class), $container->get(ImmediateSender::class));
    }
}