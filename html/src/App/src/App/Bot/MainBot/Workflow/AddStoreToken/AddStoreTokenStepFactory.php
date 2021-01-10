<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\AddStoreToken;

use App\Entity\StoreToken;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class AddStoreTokenStepFactory
{
    public function __invoke(ContainerInterface $container): AddStoreTokenStep
    {
        $entityManager = $container->get(EntityManagerInterface::class);
        $repo = $entityManager->getRepository(StoreToken::class);

        return new AddStoreTokenStep($repo);
    }
}