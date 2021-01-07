<?php
declare(strict_types=1);

namespace App\Bot\Common\Middleware;

use App\Bot\Common\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use TgShop\Dto\User;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Middleware\UserExtractorMiddleware;

class UserSaveMiddleware implements MiddlewareInterface
{
    private UserRepositoryInterface $userRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(UserRepositoryInterface $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager  = $entityManager;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var User $user */
        $user = $telegramRequest->getArgument(UserExtractorMiddleware::ARGUMENT_CURRENT_USER);

        $databaseUser = $this->userRepository->getOrCreateUser($user);

        if (!$databaseUser->getId()) {
            $this->entityManager->persist($databaseUser);
            $this->entityManager->flush($databaseUser);
        }
    }
}