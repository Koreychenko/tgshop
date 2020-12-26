<?php
declare(strict_types=1);

namespace TgShop;

use TgShop\Middleware\TelegramRequestInterface;

interface BotAppInterface
{
    public function handle(TelegramRequestInterface $telegramRequest): void;
}