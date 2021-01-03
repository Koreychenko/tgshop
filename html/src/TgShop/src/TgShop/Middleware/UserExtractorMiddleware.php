<?php
declare(strict_types=1);

namespace TgShop\Middleware;

class UserExtractorMiddleware implements MiddlewareInterface
{
    public const CURRENT_USER = 'current_user';

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $user = '';

        $telegramRequest->setArgument(static::CURRENT_USER, $user);
    }
}