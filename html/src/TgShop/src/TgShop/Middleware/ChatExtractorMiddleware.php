<?php
declare(strict_types=1);

namespace TgShop\Middleware;

class ChatExtractorMiddleware implements MiddlewareInterface
{
    public const ARGUMENT_CURRENT_CHAT = 'argument_current_chat';

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $message = $telegramRequest->getUpdate()->getMessage();

        if (!$message) {
            $callbackQuery = $telegramRequest->getUpdate()->getCallbackQuery();

            if ($callbackQuery) {
                $message = $callbackQuery->getMessage();
            }
        }

        if ($message) {
            $chat = $message->getChat();

            if ($chat) {
                $telegramRequest->setArgument(static::ARGUMENT_CURRENT_CHAT, $chat);
            }
        }
    }
}