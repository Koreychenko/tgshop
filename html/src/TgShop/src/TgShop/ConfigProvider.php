<?php
declare(strict_types=1);

namespace TgShop;

use TgShop\Cli\SendMessageCommand;
use TgShop\Cli\SetWebhookCommand;
use TgShop\Service\Bot;
use TgShop\Service\BotFactory;
use TgShop\Transport\HttpClient;
use TgShop\Transport\HttpClientFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'enabled_commands' => [
                SetWebhookCommand::class,
                SendMessageCommand::class
            ]
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                HttpClient::class => HttpClientFactory::class,
                Bot::class        => BotFactory::class,
            ],
        ];
    }
}
