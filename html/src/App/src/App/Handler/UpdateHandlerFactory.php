<?php
declare(strict_types=1);

namespace App\Handler;

use App\Service\MainBotProvider;
use App\Service\MainBotRouterFactory;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class UpdateHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdateHandler
    {
        $botProvider = $container->get(MainBotProvider::class);

        return new UpdateHandler(
            $botProvider->getBot('main_bot'),
            $container->get(MainBotRouterFactory::SERVICE_NAME),
            $container->get(LoggerInterface::class)
        );
    }
}