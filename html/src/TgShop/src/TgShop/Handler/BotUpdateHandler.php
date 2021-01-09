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
use TgShop\Exception\InvalidTokenException;
use TgShop\Middleware\TelegramRequest;

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

        $this->logger->error('test2');

        try {
            $telegramRequest = new TelegramRequest(Update::createFromArray($content));

            $defaultBot = $this->botProvider->getBot($this->getBotId($request));

            if (!$defaultBot) {
                throw new InvalidTokenException('Bot is not found');
            }

            $telegramRequest->setArgument(BotApp::DEFAULT_BOT_ARGUMENT, $defaultBot);

            $this->botApp->handle($telegramRequest);
        } catch (InvalidTokenException $exception) {
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);

            throw $exception;
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);
        }

        $this->logger->error('test');

        return new JsonResponse([]);
    }
}