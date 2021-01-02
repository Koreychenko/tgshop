<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TgShop\Exception\InvalidTokenException;

class CheckTokenMiddleware implements MiddlewareInterface
{
    protected string $accessToken;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->accessToken !== $request->getAttribute('token')) {
            throw new InvalidTokenException('Invalid access token');
        }

        return $handler->handle($request);
    }
}