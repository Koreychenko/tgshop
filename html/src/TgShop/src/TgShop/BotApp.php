<?php
declare(strict_types=1);

namespace TgShop;

use Psr\Container\ContainerInterface;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Router\RouterInterface;
use TgShop\Transport\SenderInterface;

class BotApp implements BotAppInterface
{
    public const DEFAULT_BOT_ARGUMENT = 'default_bot';

    protected RouterInterface    $router;

    protected SenderInterface    $sender;

    protected ContainerInterface $container;

    public function __construct(
        RouterInterface $router,
        SenderInterface $sender,
        ContainerInterface $container
    ) {
        $this->router          = $router;
        $this->sender          = $sender;
        $this->container       = $container;
    }

    public function handle(TelegramRequestInterface $telegramRequest): void
    {
        $routes = $this->router->match($telegramRequest);

        if (!$routes) {
            return;
        }

        foreach ($routes as $route) {
            if (is_string($route)) {
                $route = $this->container->get($route);
            }

            if ($route instanceof MiddlewareInterface) {
                $result = $route->handle($telegramRequest);

                if ($result) {
                    $this->sender->send($result);
                }
            }
        }
    }
}