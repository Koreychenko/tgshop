<?php
declare(strict_types=1);

namespace App\Processor\Handler;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class StartCommandHandlerFactory
{
    public function __invoke(ContainerInterface $container): StartCommandHandler
    {
        return new StartCommandHandler($container->get(LoggerInterface::class));
    }
}