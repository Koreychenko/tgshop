<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware\String;

use App\Bot\MainBot\Helper\Keyboard;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;

class SettingsMiddleware implements MiddlewareInterface
{
    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $message = new SendMessage($chat->getId(), 'Settings:');
        $message->setReplyMarkup(Keyboard::getSettingsKeyboard());

        $telegramResponse->addDefaultBotCommand($message);
    }
}