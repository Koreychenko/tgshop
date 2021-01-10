<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\AddStoreToken;

use App\Bot\Common\Repository\StoreTokenRepositoryInterface;
use InvalidArgumentException;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\State\StateInterface;
use TgShop\Workflow\WorkflowHandler;
use TgShop\Workflow\WorkflowStep;

class AddStoreTokenStep extends WorkflowStep
{
    protected StoreTokenRepositoryInterface $storeTokenRepository;

    public function __construct(StoreTokenRepositoryInterface $storeTokenRepository)
    {
        $this->storeTokenRepository = $storeTokenRepository;
    }

    public function validate(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        if (!$telegramRequest->getUpdate()) {
            throw new InvalidArgumentException('Update is empty');
        }

        if (!$telegramRequest->getUpdate()->getMessage()) {
            throw new InvalidArgumentException('Please send text message');
        }
    }

    public function beforeStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        /** @var StateInterface $state */
        $state = $telegramRequest->getArgument(WorkflowHandler::ARGUMENT_CURRENT_STATE);

        $storeId = $telegramRequest->getParameter('id');

        if (!$storeId) {
            throw new InvalidArgumentException('Store id should be provided');
        }

        $telegramResponse->addDefaultBotCommand(
            new SendMessage(
                $chat->getId(),
                'Create new bot using @botfather and send here the token you\'ll get'
            )
        );

        $state->addParameter('id', $storeId);
    }

    public function processStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $botToken = $telegramRequest->getUpdate()->getMessage()->getText();
        $accessToken = bin2hex(random_bytes(32));

        /** @var StateInterface $state */
        $state = $telegramRequest->getArgument(WorkflowHandler::ARGUMENT_CURRENT_STATE);

        $storeId = (int) $state->getParameter('id');

        $this->storeTokenRepository->addStoreToken($storeId, $botToken, $accessToken);
    }

    public function afterStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $telegramResponse->addDefaultBotCommand(
            new SendMessage(
                $chat->getId(),
                'The token has been added. Your new bot is ready to serve.'
            )
        );
    }
}