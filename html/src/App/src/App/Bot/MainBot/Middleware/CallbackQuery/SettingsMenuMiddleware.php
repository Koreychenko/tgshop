<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware\CallbackQuery;

use App\Bot\MainBot\Helper\Keyboard;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;

class SettingsMenuMiddleware implements MiddlewareInterface
{
    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $option = $telegramRequest->getParameter('option');

        switch ($option) {
            case 'language':
                $message = new SendMessage($chat->getId(), 'Choose language:');
                $message->setReplyMarkup(Keyboard::getSwitchLanguageKeyboard());

                $telegramResponse->addDefaultBotCommand($message);

                break;
        }
    }
}