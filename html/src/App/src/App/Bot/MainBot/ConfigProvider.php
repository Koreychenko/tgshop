<?php
declare(strict_types=1);

namespace App\Bot\MainBot;

use App\Bot\MainBot\Http\Handler\UpdateHandlerFactory;
use App\Bot\MainBot\Http\Middleware\CheckTokenMiddleware;
use App\Bot\MainBot\Http\Middleware\CheckTokenMiddlewareFactory;
use App\Bot\MainBot\Router\RouteConfigurationFactory;
use App\Bot\MainBot\Router\RouterFactory;
use App\Cli\SendMessageCommandFactory;
use App\Cli\SetWebhookCommandFactory;
use TgShop\Cli\SendMessageCommand;
use TgShop\Cli\SetWebhookCommand;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies'     => $this->getDependencies(),
            'enabled_commands' => $this->getEnabledCliCommands(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories' => [
                SetWebhookCommand::class                => SetWebhookCommandFactory::class,
                SendMessageCommand::class               => SendMessageCommandFactory::class,
                BotProvider::class                      => BotProviderFactory::class,
                BotAppFactory::SERVICE_NAME             => BotAppFactory::class,
                RouterFactory::SERVICE_NAME             => RouterFactory::class,
                RouteConfigurationFactory::SERVICE_NAME => RouteConfigurationFactory::class,
                UpdateHandlerFactory::SERVICE_NAME      => UpdateHandlerFactory::class,
                CheckTokenMiddleware::class             => CheckTokenMiddlewareFactory::class,
            ],
            'cli'       => [
            ],
        ];
    }

    private function getEnabledCliCommands(): array
    {
        return [
            SetWebhookCommand::class,
            SendMessageCommand::class,
        ];
    }
}