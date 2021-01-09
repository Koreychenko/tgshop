<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use Spatie\Emoji\Emoji;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\State\StateRepositoryInterface;

class CancelWorkflowMiddleware implements MiddlewareInterface
{
    protected StateRepositoryInterface $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $state = $telegramRequest->getArgument(StateExtractorMiddleware::ARGUMENT_CURRENT_STATE);

        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        if ($state) {
            $this->stateRepository->remove($state);

            $telegramResponse->addDefaultBotCommand(new SendMessage($chat->getId(), Emoji::CHARACTER_CHECK_MARK . 'The process has been canceled'));
        }
    }
}