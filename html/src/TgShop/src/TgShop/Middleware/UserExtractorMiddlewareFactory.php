<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use Psr\Container\ContainerInterface;

final class UserExtractorMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): UserExtractorMiddleware
    {
        return new UserExtractorMiddleware();
    }
}