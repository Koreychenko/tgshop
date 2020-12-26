<?php
declare(strict_types=1);

namespace TgShop;

use TgShop\Cli\SendMessageCommand;
use TgShop\Cli\SetWebhookCommand;
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
            'enabled_commands' => [
                SetWebhookCommand::class,
                SendMessageCommand::class,
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                HttpClient::class      => HttpClientFactory::class,
                ImmediateSender::class => ImmediateSenderFactory::class,
            ],
        ];
    }
}
