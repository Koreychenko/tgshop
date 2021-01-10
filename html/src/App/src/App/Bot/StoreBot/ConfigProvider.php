<?php
declare(strict_types=1);

namespace App\Bot\StoreBot;

use App\Bot\StoreBot\Http\Handler\UpdateHandlerFactory;
use App\Bot\StoreBot\Middleware\RouterMiddlewareFactory;
use App\Bot\StoreBot\Router\RouteConfigurationFactory;
use App\Bot\StoreBot\Router\RouterFactory;
use App\Bot\StoreBot\Service\SetWebhookService;
use App\Bot\StoreBot\Service\SetWebhookServiceFactory;

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
            ],
            'factories'  => [
                BotAppFactory::SERVICE_NAME             => BotAppFactory::class,
                UpdateHandlerFactory::SERVICE_NAME      => UpdateHandlerFactory::class,
                RouteConfigurationFactory::SERVICE_NAME => RouteConfigurationFactory::class,
                RouterFactory::SERVICE_NAME             => RouterFactory::class,
                BotProvider::class                      => BotProviderFactory::class,
                RouterMiddlewareFactory::SERVICE_NAME   => RouterMiddlewareFactory::class,
                SetWebhookService::class                => SetWebhookServiceFactory::class,
            ],
            'cli'        => [
            ],
        ];
    }
}