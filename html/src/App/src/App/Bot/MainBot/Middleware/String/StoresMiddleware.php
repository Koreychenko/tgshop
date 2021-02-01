<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware\String;

use App\Bot\MainBot\Helper\StoreKeyboard;
use App\Entity\User;
use Spatie\Emoji\Emoji;
use TgShop\Command\Element\InlineKeyboardButton;
use TgShop\Command\Element\InlineKeyboardMarkup;
use TgShop\Command\Element\InlineKeyboardRow;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Middleware\UserExtractorMiddleware;

class StoresMiddleware implements MiddlewareInterface
{
    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        /** @var User $user */
        $user = $telegramRequest->getArgument(UserExtractorMiddleware::ARGUMENT_CURRENT_USER);

        $stores = $user->getStores();

        if (!count($stores)) {
            $message = new SendMessage($chat->getId(), 'You have no stores yet.');

            $telegramResponse->addDefaultBotCommand($message);

            return;
        }

        $message = new SendMessage($chat->getId(), 'Your stores:');
        $telegramResponse->addDefaultBotCommand($message);

        foreach ($user->getStores() as $store)
        {
            $message = new SendMessage($chat->getId(), $store->getName());

            $message->setReplyMarkup(StoreKeyboard::getKeyboard($store->getId()));

            $telegramResponse->addDefaultBotCommand($message);
        }
    }
}