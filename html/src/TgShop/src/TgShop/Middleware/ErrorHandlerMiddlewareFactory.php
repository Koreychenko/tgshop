<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class ErrorHandlerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ErrorHandlerMiddleware
    {
        return new ErrorHandlerMiddleware($container->get(LoggerInterface::class));
    }
}