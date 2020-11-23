<?php
declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

final class CheckTokenMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CheckTokenMiddleware
    {
        $accessToken = $container->get('config')['telegram']['main_bot']['access_token'];

        return new CheckTokenMiddleware(
            $accessToken
        );
    }
}