<?php
declare(strict_types=1);

namespace TgShop\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use TgShop\BotApp;
use TgShop\BotAppInterface;
use TgShop\BotProviderInterface;
use TgShop\Dto\Update;
use TgShop\Middleware\TelegramRequest;
use Throwable;

class BotUpdateHandler implements RequestHandlerInterface
{
    protected BotAppInterface      $botApp;

    protected BotProviderInterface $botProvider;

    protected LoggerInterface      $logger;

    public function __construct(
        BotAppInterface $botApp,
        BotProviderInterface $botProvider,
        LoggerInterface $logger
    ) {
        $this->botApp      = $botApp;
        $this->botProvider = $botProvider;
        $this->logger      = $logger;
    }

    public function getBotId(ServerRequestInterface $request = null): string
    {
        return 'mainBot';
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $content = json_decode($request->getBody()->getContents(), true);

        try {
            $telegramRequest = new TelegramRequest(Update::createFromArray($content));

            $defaultBot = $this->botProvider->getBot($this->getBotId($request));

            $telegramRequest->setArgument(BotApp::DEFAULT_BOT_ARGUMENT, $defaultBot);

            $this->botApp->handle($telegramRequest);
        } catch (Throwable $exception) {
            $this->logger->error('telegram_data', ['update' => $exception]);
        }

        return new JsonResponse([]);
    }
}