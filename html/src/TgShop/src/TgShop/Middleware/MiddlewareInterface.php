<?php
declare(strict_types=1);

namespace TgShop\Middleware;

interface MiddlewareInterface
{
    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse);
}