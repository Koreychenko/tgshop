<?php
declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class UpdateHandlerFactory
{
    public function __invoke(ContainerInterface $container): UpdateHandler
    {
        return new UpdateHandler(
            $container->get(LoggerInterface::class)
        );
    }
}