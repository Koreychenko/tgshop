<?php
declare(strict_types=1);

namespace TgShop;

use TgShop\Router\Matcher\CommandMatcher;
use TgShop\Router\Matcher\InlineQueryMatcher;
use TgShop\Router\Matcher\StateMatcher;
use TgShop\Router\Matcher\StateMatcherFactory;
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
            'dependencies'     => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                CommandMatcher::class,
                InlineQueryMatcher::class,
                StringMatcher::class,
            ],
            'factories'  => [
                HttpClient::class      => HttpClientFactory::class,
                ImmediateSender::class => ImmediateSenderFactory::class,
                StateMatcher::class    => StateMatcherFactory::class,
            ],
        ];
    }
}
