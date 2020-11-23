<?php
declare(strict_types=1);

namespace App\Service;

use Psr\Container\ContainerInterface;
use TgShop\Service\Bot;

final class MainBotProviderFactory
{
    public function __invoke(ContainerInterface $container): MainBotProvider
    {
        $token = $container->get('config')['telegram']['main_bot']['token'];

        return new MainBotProvider(
            $token,
            $container->get(Bot::class)
        );
    }
}