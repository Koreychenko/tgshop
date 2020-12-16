<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class ExtractStoreParametersMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ExtractStoreParametersMiddleware
    {
        $entityManager = $container->get(EntityManagerInterface::class);
        $repository = $entityManager->getRepository(Store::class);

        return new ExtractStoreParametersMiddleware($repository);
    }
}