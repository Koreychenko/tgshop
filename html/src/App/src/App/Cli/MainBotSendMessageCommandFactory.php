<?php
declare(strict_types=1);

namespace App\Cli;

use App\Service\MainBotProvider;
use Psr\Container\ContainerInterface;
use TgShop\Cli\SendMessageCommand;

final class MainBotSendMessageCommandFactory
{
    public function __invoke(ContainerInterface $container): SendMessageCommand
    {
        return new SendMessageCommand($container->get(MainBotProvider::class));
    }
}