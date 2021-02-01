<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\AddStore;

use App\Bot\Common\Repository\StoreRepositoryInterface;
use InvalidArgumentException;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Middleware\UserExtractorMiddleware;
use TgShop\Workflow\WorkflowStep;

class AddStoreNameStep extends WorkflowStep
{
    protected StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function afterStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $chat = $this->getDefaultChat($telegramRequest);

        $telegramResponse->addDefaultBotCommand(new SendMessage($chat->getId(),
                                                                'Congrats! Your store has been created!'));
    }

    public function beforeStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $chat = $this->getDefaultChat($telegramRequest);

        $telegramResponse->addDefaultBotCommand(new SendMessage($chat->getId(), 'Enter store name'));
    }

    public function processStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $user      = $telegramRequest->getArgument(UserExtractorMiddleware::ARGUMENT_CURRENT_USER);
        $storeName = $telegramRequest->getUpdate()->getMessage()->getText();

        $this->storeRepository->createStore($storeName, $user);
    }

    public function validate(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        if (!$telegramRequest->getUpdate()) {
            throw new InvalidArgumentException('Update is empty');
        }

        if (!$telegramRequest->getUpdate()->getMessage()) {
            throw new InvalidArgumentException('Please send text message');
        }

        $storeName = $telegramRequest->getUpdate()->getMessage()->getText();

        if (mb_strlen($storeName) < 3) {
            throw new InvalidArgumentException('Store name should be at least 3 characters long');
        }

        $user = $telegramRequest->getArgument(UserExtractorMiddleware::ARGUMENT_CURRENT_USER);

        $stores = $this->storeRepository->getStoreByName($storeName, $user);

        if (count($stores)) {
            throw new InvalidArgumentException('You already have a store with the same name');
        }
    }
}