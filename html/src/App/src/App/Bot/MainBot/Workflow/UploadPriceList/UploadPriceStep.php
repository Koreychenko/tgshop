<?php

declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\UploadPriceList;

use InvalidArgumentException;
use TgShop\BotApp;
use TgShop\Command\GetFile;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Service\DownloadFileService;
use TgShop\State\StateInterface;
use TgShop\Workflow\WorkflowHandler;
use TgShop\Workflow\WorkflowStep;

class UploadPriceStep extends WorkflowStep
{
    protected DownloadFileService $downloadFileService;

    public function __construct(DownloadFileService $downloadFileService)
    {
        $this->downloadFileService = $downloadFileService;
    }

    public function validate(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $errorText = 'Please send valid document';

        if (!$telegramRequest->getUpdate()->getMessage()) {
            throw new InvalidArgumentException($errorText);
        }

        if (!$telegramRequest->getUpdate()->getMessage()->getDocument()) {
            throw new InvalidArgumentException($errorText);
        }
    }

    public function beforeStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $telegramResponse->addDefaultBotCommand(
            new SendMessage(
                $chat->getId(),
                'Send here XLSX (MS Excel) file with price list of your new store'
            )
        );

        /** @var StateInterface $state */
        $state = $telegramRequest->getArgument(WorkflowHandler::ARGUMENT_CURRENT_STATE);

        $storeId = $telegramRequest->getParameter('id');

        if (!$storeId) {
            throw new InvalidArgumentException('Store id should be provided');
        }

        $state->addParameter('id', $storeId);
    }

    public function processStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $bot = $telegramRequest->getArgument(BotApp::DEFAULT_BOT_ARGUMENT);

        $document = $telegramRequest->getUpdate()->getMessage()->getDocument();

        $file = $this->downloadFileService->download($document->getFileId(), $bot);

        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $telegramResponse->addDefaultBotCommand(
            new SendMessage(
                $chat->getId(),
                $file
            )
        );

    }

    public function afterStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Chat $chat */
        $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);

        $telegramResponse->addDefaultBotCommand(
            new SendMessage(
                $chat->getId(),
                'Cool! Thank you. We\'re going to process your price and create products'
            )
        );
    }
}