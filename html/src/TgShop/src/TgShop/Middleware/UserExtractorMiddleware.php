<?php
declare(strict_types=1);

namespace TgShop\Middleware;

class UserExtractorMiddleware implements MiddlewareInterface
{
    public const ARGUMENT_CURRENT_USER = 'current_user';

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $message = $telegramRequest->getUpdate()->getMessage();

        if (!$message) {
            $message = $telegramRequest->getUpdate()->getCallbackQuery();
        }

        if ($message) {
            $user = $message->getFrom();

            if ($user) {
                $telegramRequest->setArgument(static::ARGUMENT_CURRENT_USER, $user);
            }
        }
    }
}