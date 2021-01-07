<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use Exception;
use Psr\Log\LoggerInterface;
use TgShop\Command\SendMessage;
use TgShop\Dto\Chat;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        /** @var Exception $error */
        $error = $telegramRequest->getArgument(TelegramRequest::PIPELINE_ERROR);

        if ($error) {
            $this->logger->critical($error->getMessage(), ['exception' => $error]);
            $telegramResponse->clearCommands();
            /** @var Chat $chat */
            $chat = $telegramRequest->getArgument(ChatExtractorMiddleware::ARGUMENT_CURRENT_CHAT);
            $telegramResponse->addDefaultBotCommand(new SendMessage($chat->getId(), $error->getMessage()));

            return $telegramResponse;
        }
    }
}