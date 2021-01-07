<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Cli;

use App\Bot\MainBot\BotProvider;
use Psr\Container\ContainerInterface;
use TgShop\Cli\SendMessageCommand;
use TgShop\Transport\ImmediateSender;

final class SendMessageCommandFactory
{
    public function __invoke(ContainerInterface $container): SendMessageCommand
    {
        return new SendMessageCommand($container->get(BotProvider::class), $container->get(ImmediateSender::class));
    }
}