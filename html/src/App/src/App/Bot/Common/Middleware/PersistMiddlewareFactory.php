<?php
declare(strict_types=1);

namespace App\Bot\Common\Middleware;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class PersistMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PersistMiddleware
    {
        return new PersistMiddleware(
            $container->get(EntityManagerInterface::class)
        );
    }
}