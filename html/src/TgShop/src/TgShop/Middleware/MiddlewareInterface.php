<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use TgShop\Model\CommandCollection;

interface MiddlewareInterface
{
    public function handle(TelegramRequestInterface $telegramRequest): ?CommandCollection;
}