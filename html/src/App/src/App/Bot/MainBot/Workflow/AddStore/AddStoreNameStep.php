<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\AddStore;

use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Workflow\WorkflowStep;

class AddStoreNameStep extends WorkflowStep
{
    public function beforeStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $telegramResponse->addDefaultBotCommand(new SendMessage($chat->getId(), 'Enter store name'));
    }

    public function afterStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $telegramResponse->addDefaultBotCommand(new SendMessage($chat->getId(), 'Congrats! Your store has been created!'));
    }
}