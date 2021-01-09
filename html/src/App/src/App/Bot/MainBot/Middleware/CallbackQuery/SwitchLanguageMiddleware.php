<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware\CallbackQuery;

use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;

class SwitchLanguageMiddleware implements MiddlewareInterface
{
    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $language = $telegramRequest->getParameter('lang');

        if ($language) {
            $message = new SendMessage($chat->getId(), 'Language is changed');

            $telegramResponse->addDefaultBotCommand($message);
        }
    }
}