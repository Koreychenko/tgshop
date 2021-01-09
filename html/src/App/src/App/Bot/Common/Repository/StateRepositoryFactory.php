<?php
declare(strict_types=1);

namespace App\Bot\Common\Repository;

use App\Entity\State;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use TgShop\State\StateRepositoryInterface;

final class StateRepositoryFactory
{
    public function __invoke(ContainerInterface $container): StateRepositoryInterface
    {
        $entityManager = $container->get(EntityManagerInterface::class);

        return $entityManager->getRepository(State::class);
    }
}