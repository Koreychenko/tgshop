<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware;

use App\Bot\MainBot\Helper\Keyboard;
use App\Entity\User;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Middleware\UserExtractorMiddleware;

class MainKeyboardMiddleware implements MiddlewareInterface
{
    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        /** @var User $user */
        $user = $telegramRequest->getArgument(UserExtractorMiddleware::ARGUMENT_CURRENT_USER);

        $message = new SendMessage($chat->getId(), 'Menu:');

        if (!count($user->getStores())) {
            $message->setReplyMarkup(Keyboard::getNoStoreKeyboard());
        } else {
            $message->setReplyMarkup(Keyboard::getMainKeyboard());
        }

        $telegramResponse->addDefaultBotCommand($message);
    }
}