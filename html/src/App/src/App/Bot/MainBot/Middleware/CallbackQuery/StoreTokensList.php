<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware\CallbackQuery;

use App\Bot\Common\Repository\StoreRepositoryInterface;
use App\Bot\MainBot\Helper\StoreTokenKeyboard;
use App\Entity\Store;
use InvalidArgumentException;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;

class StoreTokensList implements MiddlewareInterface
{
    protected StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $storeId = $telegramRequest->getParameter('id');

        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        /** @var Store $store */
        $store = $this->storeRepository->find($storeId);

        if (!$store) {
            throw new InvalidArgumentException('Invalid store id');
        }

        foreach ($store->getStoreTokens() as $token) {
            $message = new SendMessage(
                $chat->getId(),
                substr($token->getBotToken(), 0, 4) .
                str_repeat('.', strlen($token->getBotToken()) - 8) .
                substr($token->getBotToken(), -4)
            );

            $message->setReplyMarkup(StoreTokenKeyboard::getKeyboard($token->getId(), $token->isActive()));

            $telegramResponse->addDefaultBotCommand($message);
        }
    }
}