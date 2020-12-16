<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Repository\StoresRepositoryInterface;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExtractStoreParametersMiddleware implements MiddlewareInterface
{
    public const ARGUMENT_STORE_TOKEN = 'store_token';

    private StoresRepositoryInterface $storesRepository;

    public function __construct(StoresRepositoryInterface $storesRepository)
    {
        $this->storesRepository = $storesRepository;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getAttribute('token');

        if (!$token) {
            throw new InvalidArgumentException('Invalid token provided');
        }

        $store = $this->storesRepository->getStoreByToken($token);

        if (!$store) {
            throw new InvalidArgumentException('Invalid token provided');
        }

        return $handler->handle($request->withAttribute(static::ARGUMENT_STORE_TOKEN, $store));
    }
}