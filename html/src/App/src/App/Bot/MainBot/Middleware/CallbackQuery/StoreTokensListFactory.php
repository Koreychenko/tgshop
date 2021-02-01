<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware\CallbackQuery;

use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class StoreTokensListFactory
{
    public function __invoke(ContainerInterface $container): StoreTokensList
    {
        $entityManager = $container->get(EntityManagerInterface::class);

        return new StoreTokensList(
            $entityManager->getRepository(Store::class)
        );
    }
}