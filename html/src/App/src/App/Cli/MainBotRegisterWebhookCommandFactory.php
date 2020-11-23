<?php
declare(strict_types=1);

namespace App\Cli;

use App\Service\MainBotProvider;
use Psr\Container\ContainerInterface;
use TgShop\Cli\RegisterWebhookCommand;

final class MainBotRegisterWebhookCommandFactory
{
    public function __invoke(ContainerInterface $container): RegisterWebhookCommand
    {
        return new RegisterWebhookCommand($container->get(MainBotProvider::class));
    }
}