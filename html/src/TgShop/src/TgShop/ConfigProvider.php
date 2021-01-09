<?php
declare(strict_types=1);

namespace TgShop;

use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\ErrorHandlerMiddleware;
use TgShop\Middleware\ErrorHandlerMiddlewareFactory;
use TgShop\Middleware\HandlerMiddleware;
use TgShop\Middleware\StateExtractorMiddleware;
use TgShop\Middleware\StateExtractorMiddlewareFactory;
use TgShop\Middleware\UserExtractorMiddleware;
use TgShop\Middleware\UserExtractorMiddlewareFactory;
use TgShop\Router\Matcher\CommandMatcher;
use TgShop\Router\Matcher\InlineQueryMatcher;
use TgShop\Router\Matcher\StateMatcher;
use TgShop\Router\Matcher\StringMatcher;
use TgShop\Transport\HttpClient;
use TgShop\Transport\HttpClientFactory;
use TgShop\Transport\ImmediateSender;
use TgShop\Transport\ImmediateSenderFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                CommandMatcher::class,
                InlineQueryMatcher::class,
                StringMatcher::class,
                HandlerMiddleware::class,
                ChatExtractorMiddleware::class,
                StateMatcher::class,
            ],
            'factories'  => [
                HttpClient::class               => HttpClientFactory::class,
                ImmediateSender::class          => ImmediateSenderFactory::class,
                UserExtractorMiddleware::class  => UserExtractorMiddlewareFactory::class,
                ErrorHandlerMiddleware::class   => ErrorHandlerMiddlewareFactory::class,
                StateExtractorMiddleware::class => StateExtractorMiddlewareFactory::class,
            ],
        ];
    }
}
