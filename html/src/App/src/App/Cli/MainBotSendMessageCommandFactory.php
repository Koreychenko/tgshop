<?php
declare(strict_types=1);

namespace App\Cli;

use App\Service\MainStaticBotProvider;
use Psr\Container\ContainerInterface;
use TgShop\Cli\SendMessageCommand;

final class MainBotSendMessageCommandFactory
{
    public function __invoke(ContainerInterface $container): SendMessageCommand
    {
        return new SendMessageCommand($container->get(MainStaticBotProvider::class));
    }
}