<?php
declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Command\SendMessage;
use TgShop\Dto\Update;
use TgShop\Service\Bot;
use TgShop\Service\Router;
use Throwable;

class UpdateHandler implements RequestHandlerInterface
{
    protected LoggerInterface $logger;

    protected Bot $bot;

    protected Router $router;

    public function __construct(Bot $bot, Router $router, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->bot    = $bot;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $content = json_decode($request->getBody()->getContents(), true);

        $this->logger->error('telegram_data', ['update' => $content]);

        try {
            $update = Update::createFromArray($content);

            $commands = $this->router->handle($update);

            if (!is_array($commands)) {
                $commands = [$commands];
            }

            if ($commands) {
                foreach ($commands as $command) {
                    $this->bot->send($command);
                }
            }
        } catch (Throwable $exception) {
            $this->logger->error('telegram_data', ['update' => $exception]);
        }

        return new JsonResponse([]);
    }
}