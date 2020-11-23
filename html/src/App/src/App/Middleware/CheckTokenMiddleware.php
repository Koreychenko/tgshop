<?php
declare(strict_types=1);

namespace App\Middleware;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

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
            throw new InvalidArgumentException('Invalid access token');
        }

        return $handler->handle($request);
    }
}