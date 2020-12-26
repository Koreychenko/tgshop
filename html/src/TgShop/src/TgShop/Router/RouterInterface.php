<?php
declare(strict_types=1);

namespace TgShop\Router;

use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;

interface RouterInterface
{
    /**
     * @param TelegramRequestInterface $telegramRequest
     * @return MiddlewareInterface[]|null
     */
    public function match(TelegramRequestInterface $telegramRequest): ?array;
}