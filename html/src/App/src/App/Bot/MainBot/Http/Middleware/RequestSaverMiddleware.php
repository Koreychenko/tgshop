<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class RequestSaverMiddleware implements MiddlewareInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $requestBody = $request->getBody()->getContents();

        $this->logger->debug('Raw decoded request', ['request' => json_decode($requestBody)]);

        return $handler->handle($request);
    }
}