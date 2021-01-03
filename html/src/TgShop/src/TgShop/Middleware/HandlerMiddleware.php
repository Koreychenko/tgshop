<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use Exception;
use Psr\Container\ContainerInterface;

class HandlerMiddleware implements MiddlewareInterface
{
    protected ContainerInterface $container;

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $routes = $telegramRequest->getArgument(RouterMiddleware::ROUTES);

        if (empty($routes)) {
            throw new Exception('No handlers provided to handle the request');
        }

        foreach ($routes as $middleware) {
            if (is_string($middleware)) {
                $middleware = $this->container->get($middleware);
            }

            if ($middleware instanceof MiddlewareInterface) {
                $result = $middleware->handle($telegramRequest, $telegramResponse);

                /* If middleware returns an object of type TelegramResponseInterface stop
                further request processing and try to send commands list */
                if ($result and $result instanceof TelegramResponseInterface) {
                    return $result;
                }
            }
        }
    }

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}