<?php
declare(strict_types=1);

namespace App\Cli;

use App\Service\MainBotProvider;
use Psr\Container\ContainerInterface;
use TgShop\Cli\SetWebhookCommand;

final class MainBotSetWebhookCommandFactory
{
    public function __invoke(ContainerInterface $container): SetWebhookCommand
    {
        return new SetWebhookCommand($container->get(MainBotProvider::class));
    }
}