<?php
declare(strict_types=1);

namespace App\Service;

use Psr\Container\ContainerInterface;
use TgShop\Service\ImmediateSender;

final class MainBotProviderFactory
{
    public function __invoke(ContainerInterface $container): MainStaticBotProvider
    {
        $token = $container->get('config')['telegram']['main_bot']['token'];

        return new MainStaticBotProvider(
            $token,
            $container->get(ImmediateSender::class)
        );
    }
}