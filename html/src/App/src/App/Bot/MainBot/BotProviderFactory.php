<?php
declare(strict_types=1);

namespace App\Bot\MainBot;

use Psr\Container\ContainerInterface;

final class BotProviderFactory
{
    public function __invoke(ContainerInterface $container): BotProvider
    {
        $token = $container->get('config')['telegram']['main_bot']['token'];

        return new BotProvider(
            $token
        );
    }
}