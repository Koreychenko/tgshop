<?php
declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Dto\Update;
use Throwable;

class UpdateHandler implements RequestHandlerInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $content = json_decode($request->getBody()->getContents(), true);

        $this->logger->error('telegram_data', ['update' => $content]);

        try {
            $update = Update::createFromArray($content);
        } catch (Throwable $exception) {
            $this->logger->error('telegram_data', ['update' => $exception]);
        }

        return new JsonResponse([]);
    }
}