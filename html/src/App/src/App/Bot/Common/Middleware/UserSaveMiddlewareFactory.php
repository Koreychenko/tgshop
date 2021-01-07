<?php
declare(strict_types=1);

namespace App\Bot\Common\Middleware;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

final class UserSaveMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): UserSaveMiddleware
    {
        $entityManager = $container->get(EntityManagerInterface::class);

        $userRepository = $entityManager->getRepository(User::class);

        return new UserSaveMiddleware($userRepository, $entityManager);
    }
}