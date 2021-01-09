<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware\CallbackQuery;

use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class DeleteStoreMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): DeleteStoreMiddleware
    {
        $entityManager = $container->get(EntityManagerInterface::class);

        return new DeleteStoreMiddleware($entityManager->getRepository(Store::class));
    }
}