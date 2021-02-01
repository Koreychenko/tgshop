<?php

declare(strict_types=1);

namespace TgShop\Helper;

use App\Entity\State;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Workflow\WorkflowHandler;

trait ArgumentHelper
{
    public function getDefaultChat(TelegramRequestInterface $telegramRequest): ?Chat
    {
        return $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);
    }

    public function getState(TelegramRequestInterface $telegramRequest): ?State
    {
        return $telegramRequest->getArgument(WorkflowHandler::ARGUMENT_CURRENT_STATE);
    }
}