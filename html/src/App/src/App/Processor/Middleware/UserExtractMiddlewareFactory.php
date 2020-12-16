<?php
declare(strict_types=1);

namespace App\Processor\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class UserExtractMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): UserExtractMiddleware
    {
        return new UserExtractMiddleware($container->get(LoggerInterface::class));
    }
}