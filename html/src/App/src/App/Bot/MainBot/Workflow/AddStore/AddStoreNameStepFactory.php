<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\AddStore;

use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class AddStoreNameStepFactory
{
    public function __invoke(ContainerInterface $container): AddStoreNameStep
    {
        $entityManager = $container->get(EntityManagerInterface::class);

        return new AddStoreNameStep($entityManager->getRepository(Store::class));
    }
}