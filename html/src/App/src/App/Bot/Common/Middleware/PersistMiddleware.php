<?php
declare(strict_types=1);

namespace App\Bot\Common\Middleware;

use Doctrine\ORM\EntityManagerInterface;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;

class PersistMiddleware implements MiddlewareInterface
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $this->entityManager->flush();
    }
}