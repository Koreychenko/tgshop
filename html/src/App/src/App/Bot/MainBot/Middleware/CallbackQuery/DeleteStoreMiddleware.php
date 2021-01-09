<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Middleware\CallbackQuery;

use App\Bot\Common\Repository\StoreRepositoryInterface;
use InvalidArgumentException;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Dto\UserInterface;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Middleware\UserExtractorMiddleware;

class DeleteStoreMiddleware implements MiddlewareInterface
{
    protected StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var UserInterface $user */
        $user = $telegramRequest->getArgument(UserExtractorMiddleware::ARGUMENT_CURRENT_USER);

        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $storeId = $telegramRequest->getParameter('id');

        if (!$storeId) {
            return;
        }

        $store = $this->storeRepository->find($storeId);

        if ($store->getOwnerId() !== $user->getId()) {
            throw new InvalidArgumentException('You can delete only own stores');
        }

        $this->storeRepository->remove($store);

        $message = new SendMessage($chat->getId(), 'Store has been deleted');

        $telegramResponse->addDefaultBotCommand($message);
    }
}