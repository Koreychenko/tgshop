<?php
declare(strict_types=1);

namespace App\Cli;

use App\Service\MainStaticBotProvider;
use Psr\Container\ContainerInterface;
use TgShop\Cli\SetWebhookCommand;

final class MainBotSetWebhookCommandFactory
{
    public function __invoke(ContainerInterface $container): SetWebhookCommand
    {
        return new SetWebhookCommand($container->get(MainStaticBotProvider::class));
    }
}