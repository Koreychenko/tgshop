<?php
declare(strict_types=1);

namespace App\Bot\StoreBot;

use App\Entity\StoreToken;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class BotProviderFactory
{
    public function __invoke(ContainerInterface $container): BotProvider
    {
        $entityManager = $container->get(EntityManagerInterface::class);
        $repo = $entityManager->getRepository(StoreToken::class);

        return new BotProvider(
            $repo
        );
    }
}