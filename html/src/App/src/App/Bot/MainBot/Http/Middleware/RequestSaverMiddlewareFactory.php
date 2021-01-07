<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Http\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class RequestSaverMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): RequestSaverMiddleware
    {
        return new RequestSaverMiddleware($container->get(LoggerInterface::class));
    }
}