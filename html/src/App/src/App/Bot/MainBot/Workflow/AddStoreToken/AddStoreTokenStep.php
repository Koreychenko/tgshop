<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\AddStoreToken;

use App\Bot\Common\Repository\StoreTokenRepositoryInterface;
use App\Bot\StoreBot\Service\SetWebhookService;
use InvalidArgumentException;
use TgShop\Command\SendMessage;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\State\StateInterface;
use TgShop\Workflow\WorkflowStep;

class AddStoreTokenStep extends WorkflowStep
{
    protected StoreTokenRepositoryInterface $storeTokenRepository;

    protected SetWebhookService $setWebhookService;

    public function __construct(StoreTokenRepositoryInterface $storeTokenRepository, SetWebhookService $setWebhookService)
    {
        $this->storeTokenRepository = $storeTokenRepository;
        $this->setWebhookService    = $setWebhookService;
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
        $chat = $this->getDefaultChat($telegramRequest);

        /** @var StateInterface $state */
        $state = $this->getState($telegramRequest);

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

        $state = $this->getState($telegramRequest);

        $storeId = (int) $state->getParameter('id');

        $storeToken = $this->storeTokenRepository->addStoreToken($storeId, $botToken, $accessToken);

        $this->setWebhookService->set($storeToken);
    }

    public function afterStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $chat = $this->getDefaultChat($telegramRequest);

        $telegramResponse->addDefaultBotCommand(
            new SendMessage(
                $chat->getId(),
                'The token has been added. Your new bot is ready to serve.'
            )
        );
    }
}