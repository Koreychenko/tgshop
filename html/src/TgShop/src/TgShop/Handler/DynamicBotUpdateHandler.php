<?php
declare(strict_types=1);

namespace TgShop\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use TgShop\DynamicBotProviderInterface;
use TgShop\Dto\Update;
use TgShop\Service\Router;
use Throwable;

class DynamicBotUpdateHandler implements RequestHandlerInterface
{
    protected LoggerInterface $logger;

    protected Router          $router;

    protected DynamicBotProviderInterface $botProvider;

    public function __construct(DynamicBotProviderInterface $botProvider, Router $router, LoggerInterface $logger)
    {
        $this->logger      = $logger;
        $this->botProvider = $botProvider;
        $this->router      = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $content = json_decode($request->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            $bot = $this->botProvider->getBotByRequest($request);

            $this->logger->error('telegram_data', ['update' => $content]);

            $update = Update::createFromArray($content);

            $commands = $this->router->handle($update);

            if ($commands) {
                if (!is_array($commands)) {
                    $commands = [$commands];
                }

                if ($commands) {
                    foreach ($commands as $command) {
                        $bot->send($command);
                    }
                }
            }
        } catch (Throwable $exception) {
            $this->logger->error('telegram_data', ['update' => $exception]);
        }

        return new JsonResponse([]);
    }
}